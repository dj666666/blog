@extends('layouts.defult')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">{{$user['name']}}</h1>

            <div class="text-center">
                <a href="{{route('follower',$user)}}" class="btn btn-info mr-2" style="color: white">粉丝{{$user->follower()->count()}}</a>
                <a href="{{route('following',$user)}}" class="btn btn-info mr-2" style="color: white">关注{{$user->following()->count()}}</a>
                @auth
                <a href="{{route('user.follow',$user)}}" class="btn btn-success">{{$followTitle}}</a>
                @endauth
            </div>

        </div>
        <div class="card-body">
            <table class="table table-{1:striped|sm|bordered|hover|inverse} table-inverse">
                <tbody>
                @foreach($blogs as $blog)
                    <tr>

                        <td >{{$blog['content']}}</td>

                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @can('delete',$blog)
                                    <form action="{{route('blog.destroy',$blog)}}" method="post">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">删除</button>
                                    </form>
                                @endcan
                                {{--@can('update',$blog)
                                    <button type="button" class="btn btn-info">修改</button>
                                @endcan
                                <a href="{{route('user.show',$blog)}}" class="btn btn-secondary">查看</a>--}}

                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted">
        {{$blogs->links()}}
    </div>
@endsection
