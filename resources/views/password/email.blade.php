@extends('layouts.defult')
@section('content')
    <form action="{{route('FindPassWordSend')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                找回密码
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">邮箱</label>
                    <input type="text" name="email" class="form-control" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">请输入注册时的邮箱</small>
                </div>
            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-success">发送</button>
            </div>

        </div>
    </form>
@endsection
