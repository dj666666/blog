@extends('layouts.defult')
@section('content')

    <form action="{{route('login')}}" method="post">
        <div class="card">
            <div class="card-header">用户登入</div>
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="">邮箱</label>
                    <input type="text" class="form-control" name="email" value="{{old('email')}}">

                </div>
                <div class="form-group">
                    <label for="">密码</label>
                    <input type="text" class="form-control" name="password" id="" placeholder="">

                </div>
                <div class="form-group">
                    <label for=""></label>
                    <a href="{{route('FindPassWordEmail')}}">找回密码</a>

                </div>

            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn-success">登入</button>
            </div>
        </div>
    </form>
@endsection
