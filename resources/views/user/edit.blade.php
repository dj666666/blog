@extends('layouts.defult')
@section('content')

    <form action="{{route('user.update',$user)}}" method="post">
        <div class="card">
            <div class="card-header">资料修改</div>
            <div class="card-body">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label >昵称</label>
                    <input type="text" class="form-control" name="name"  value="{{$user['name']}}" >

                </div>
                <div class="form-group">
                    <label >密码</label>
                    <input type="text" class="form-control" name="password"  >
                </div>
                <div class="form-group">
                    <label >确认密码</label>
                    <input type="text" class="form-control" name="password_confirmation" >
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn-success">提交修改</button>
            </div>
        </div>
    </form>
@endsection
