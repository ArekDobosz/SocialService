@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">

    <form action="{{ url('posts/'.$post->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group {{ $errors->has('post_content') ? 'has-error' : '' }}">
            
            @if($errors->has('post_content'))
                <div class="help-block">
                    {{ $errors->first('post_content') }}
                </div>
            @endif

            <textarea name="post_content" class="form-control" rows="4" placeholder="Co słychać?">{{ $post->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-default pull-right">Zapisz zmiany</button>
        <a href="{{ url('/users/'.Auth::id()) }}" class="btn btn-default">Wróć</a>
    </form>

    </div>
</div>
@endsection