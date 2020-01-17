@extends('layouts.defult')
@section('content')
    <div class="card">
        <div class="card-header">用户列表</div>
        <div class="card-body">
            <table class="table table-{1:striped|sm|bordered|hover|inverse} table-inverse">
                <thead class="thead-inverse|thead-default">
                <tr>
                    <th>编号</th>
                    <th>邮箱</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td scope="row">{{$user['id']}}</td>
                        <td >{{$user['name']}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @can('delete',$user)
                                    <form action="{{route('user.destroy',$user)}}" method="post">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">删除</button>
                                    </form>
                                @endcan
                                @can('update',$user)
                                    <button type="button" class="btn btn-info">修改</button>
                                @endcan
                                <a href="{{route('user.show',$user)}}" class="btn btn-secondary">查看</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            {{$users->links()}}
        </div>
    </div>

@endsection

