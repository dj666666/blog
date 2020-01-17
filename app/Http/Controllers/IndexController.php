<?php

namespace App\Http\Controllers;


use App\Blog;
use App\Mail\RegMail;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        //发邮件测试
        /*$user = User::find(1);
        \Mail::to($user)->send(new RegMail());*/
        $blogs = Blog::orderBy('id','DESC')->with('user')->paginate(10);
        return view('home',compact('blogs'));
    }
}
