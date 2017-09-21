
<form action="{{ url('/comments') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group {{ $errors->has('comment_content_'.$post->id) ? 'has-error' : '' }}">
        
        @if($errors->has('comment_content_'.$post->id))
            <div class="help-block">
                {{ $errors->first('comment_content_'.$post->id) }}
            </div>
        @endif

        <input type="text" name="comment_content_{{ $post->id }}" class="form-control" placeholder="Dodaj nowy komentarz" value="{{ old('post_content') }}">
    </div>
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <button type="submit" class="btn btn-default btn-sm pull-right">Dodaj</button>
</form>