<?php

namespace App\Http\Controllers;


use App\Mail\RegMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    //添加中间件以实现登入权限验证
    //expect 是排除不需要验证的方法
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['index','show','create','store','comfirmEmail']
        ]);

        //这个时候用户登入了，但是通过url还是可以访问到注册，使用中间件来保护
        //只能游客才能访问到这两个方法
        $this->middleware('guest',[
            'only'=>['create','store']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('user.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //在这完成数据的添加
        $data = $this->validate($request,[
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'password' =>'required|min:6|confirmed',
        ]);
        //密码加密，laravel提供的加密函数
        $data['password'] = bcrypt($data['password']);

        //新增数据
        //$user = DB::table('users')->insert($data);
        $user = User::create($data);

        //新增数据成功后，让用户直接登入
        //\Auth::attempt(['email'=>$request->email,'password'=>$request->password]);

        //发送邮件
        \Mail::to($user)->send(new RegMail($user));

        //注册成功 直接登入后 可以跳转到首页 这个时候没有注册成功提示信息，可以在首页做
        //session的flash闪存
        session()->flash('success','请查看邮箱完成注册验证');
        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $blogs = $user->blogs()->paginate(10);
        if(\Auth::check())
        $followTitle = $user->isFollow(\Auth::user()->id) ? '取消关注':'关注';
        return view('user.show',compact('user','blogs','followTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {


        //调用authorize方法执行update这个策略验证，传当前登入用户
        //$this->authorize('update',$user);
        $this->authorize('update',$user);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //在这完成数据的添加
        $this->validate($request,[
            'name' => 'required|min:3',
            'password' =>'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        session()->flash('success','修改成功');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete',$user);
        $user->delete();
        session()->flash('success','删除成功');
        return  back();
    }


    public function comfirmEmail($token){
        //在这个方法里面进程测试，先创建出一个要发送的用户，把这个用户的资料传递到邮件模板。
        //在右键处理类中定义一个公共属性，new RegMail($user)传递过去，模板里就可以用到这个属性的值
        //

        /*$user = User::find(1);
        \Mail::to($user)->send(new RegMail($user));*/


        //点击链接后到这里，根据token查找用户
        $user = User::where('email_token',$token)->first();
        if($user){
            $user->email_active= true;
            $user->save();
            //\Auth::attempt($user);不能这样写，因为这样读取数据是没有密码的
            Auth::login($user);

            session()->flash('success','验证成功');
            return redirect('/');
        }
        session()->flash('danger','邮箱验证失败，请重试');
        return redirect('/');
    }


    //关注或取关方法
    public function follow(User $user){
        //传递过来的$user 是被关注人

        $user->followToggle(\Auth::user()->id);
        return back();
    }
}
