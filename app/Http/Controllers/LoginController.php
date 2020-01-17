<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function store(Request $request){

        $this->validate($request,[
            'email' => 'required|email',
            'password' =>'required|min:6',
        ]);

        if(\Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            session()->flash('success','登入成功');
            return redirect()->route('home');
        }

        session()->flash('danger','登入失败，账号或密码错误');
        return back();

    }
    public function logout(){

        \Auth::logout();
        session()->flash('success','退出成功');
        return redirect()->route('home');

    }
}
