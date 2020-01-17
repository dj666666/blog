<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel56</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="container mt-lg-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{route('home')}}">首页</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a href="{{route('user.index')}}" class="nav-link" href="#">用户列表 <span class="sr-only">(current)</span></a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                @auth
                    <a href="{{route('user.show',auth()->user())}} "class="btn btn-dark my-2 my-sm-0 mr-2" >个人空间</a>
                    <a href="{{route('user.edit',auth()->user())}} "class="btn btn-info my-2 my-sm-0 mr-2" >修改资料</a>
                    <a href="{{route('loginout')}} "class="btn btn-danger my-2 my-sm-0 mr-2" >退出</a>
                @else
                    <a href="{{route('login')}}" class="btn btn-success my-2 my-sm-0 mr-2" >登入</a>
                    <a href="{{route('user.create')}}" class="btn btn-danger my-2 my-sm-0 mr-2" >注册</a>
                @endauth

            </form>
        </div>
    </nav>
    @include('layouts._errors')
    @include('layouts._message')
    @yield('content')
</div>

<script src="/js/app.js"></script>
</body>
</html>
