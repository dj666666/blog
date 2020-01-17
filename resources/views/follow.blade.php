@extends('layouts.defult')
@section('content')

    <div class="card mt-2">
        <div class="card-header">
            {{$title}}
        </div>
        <div class="card-body">
            <table class="table table-{1:striped|sm|bordered|hover|inverse} table-inverse">
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td ><a href="{{route('user.show',$user)}}">{{$user['name']}}</a></td>
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
