@foreach(['success','danger'] as $t)
    @if(session()->has($t))

        <div class="alert alert-{{$t}} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{session()->get($t)}}
        </div>

    @endif
@endforeach
