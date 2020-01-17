@extends('layouts.defult');
@section('content')

    <form action="{{route('user.store')}}" method="post">
        <div class="card">
            <div class="card-header">用户注册</div>
            <div class="card-body">
                @csrf

                <div class="form-group">
                    <label for="">昵称</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}" id="" placeholder="">

                </div>
                <div class="form-group">
                    <label for="">邮箱</label>
                    <input type="text" class="form-control" name="email" value="{{old('email')}}" id="" placeholder="">

                </div>
                <div class="form-group">
                    <label for="">密码</label>
                    <input type="text" class="form-control" name="password" id="" placeholder="">

                </div>
                <div class="form-group">
                    <label for="">确认密码</label>
                    <input type="text" class="form-control" name="password_confirmation" id="" placeholder="">

                </div>
            </div>
            <div class="card-footer text-muted ">
                <button type="submit" class="btn-success">提交注册</button>
            </div>
        </div>
    </form>
@endsection
