@extends('layouts.defult')
@section('content')
    <form action="{{route('FindPassWordUpdate')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                重置密码
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">邮箱</label>
                    <input type="text" name="email" disabled class="form-control" value="{{$user['email']}}">
                </div>
                <input type="hidden" name="token" value="{{$user['email_token']}}">
                <div class="form-group">
                    <label for="">密码</label>
                    <input type="password" name="password" class="form-control" >

                </div>
                <div class="form-group">
                    <label for="">确认密码</label>
                    <input type="password" name="password_confirmation" class="form-control" >

                </div>
            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-success">确定修改</button>
            </div>

        </div>
    </form>
@endsection
