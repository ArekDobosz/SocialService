@if(Auth::id() === $user->id)
<form action="{{ url('posts') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group {{ $errors->has('post_content') ? 'has-error' : '' }}">
        
        @if($errors->has('post_content'))
            <div class="help-block">
                {{ $errors->first('post_content') }}
            </div>
        @endif

        <textarea name="post_content" class="form-control" rows="4" placeholder="Co słychać?">{{ old('post_content') }}</textarea>
    </div>
    <button type="submit" class="btn btn-default pull-right">Dodaj</button>
</form>
@endif