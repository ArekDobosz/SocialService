@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">

    <form action="{{ url('comments/'.$comment->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group {{ $errors->has('comment_content') ? 'has-error' : '' }}">
            
            @if($errors->has('comment_content'))
                <div class="help-block">
                    {{ $errors->first('comment_content') }}
                </div>
            @endif

            <input type="text" name="comment_content" class="form-control" value="{{ $comment->content }}" placeholder="Co słychać?">
        </div>
        <button type="submit" class="btn btn-default pull-right">Zapisz zmiany</button>
        <a href="{{ url('/users/'.Auth::id()) }}" class="btn btn-default">Wróć</a>
    </form>

    </div>
</div>
@endsection