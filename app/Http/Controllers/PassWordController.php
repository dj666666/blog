<?php

namespace App\Http\Controllers;

use App\Notifications\FindPasswordNotify;
use App\User;

use Illuminate\Http\Request;

class PassWordController extends Controller
{
    //找回密码模板
    public function email(){
        return view('password.email');
    }

    //发送邮箱
    public function send(Request $request){
        $user = User::where('email', $request->email)->first();

        //然后执行发送通知的操作
        \Notification::send($user, new FindPasswordNotify($user->email_token));
        return view('password.send');
    }

    //修改模板
    public function edit($token){
        $user = $this->getUserByToken($token);
        return view('password.edit',compact('user'));
    }

    //修改操作
    public function update(Request $request){

        $this->validate($request,[
            'password' =>'required|min:6|confirmed',
        ]);
        $user = $this->getUserByToken($request->token);
        $user->password  = bcrypt($request->password);
        $user->save();

        session()->flash('success','重置密码成功');
        return redirect()->route('login');
    }


    protected function getUserByToken($token)
    {
        return User::where('email_token', $token)->first();
    }

}
