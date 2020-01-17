@extends('layouts.defult')
@section('content')
    @auth
    <div class="card">
        <form action="{{route('blog.store')}}" method="post">
            @csrf

            <div class="card-header">
                发布博客
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label for="">内容</label>
                    <textarea class="form-control" name="content" rows="3"></textarea>
                </div>

            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-success">发布</button>
            </div>
        </form>
    </div>
    @endauth

    {{--博客列表--}}
    <div class="card mt-2">
        <div class="card-header">博客列表</div>
        <div class="card-body">
            <table class="table table-{1:striped|sm|bordered|hover|inverse} table-inverse">
               {{-- <thead class="thead-inverse|thead-default">
                <tr>
                    <th>编号</th>
                    <th>内容</th>
                    <th>操作</th>
                </tr>
                </thead>--}}
                <tbody>
                @foreach($blogs as $blog)
                    <tr>

                        <td >{{$blog['content']}}</td>
                        <td ><a href="{{route('user.show',$blog->user)}}">{{$blog->user->name}}</a></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @can('delete',$blog)
                                    <form action="{{route('blog.destroy',$blog->user)}}" method="post">
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
        <div class="card-footer text-muted">
            {{$blogs->links()}}
        </div>
    </div>
@endsection
