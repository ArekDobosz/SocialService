
@if(Auth::check())
    
    @if(!Auth::user()->likes->contains('post_id', $post->id))
        <form action="{{ url('/likes') }}" method="POST">                
            {{ csrf_field() }}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="clearfix">
            <button type="submit" class="btn btn-primary btn-xs pull-right">
                Polub
                <span class="glyphicon glyphicon-thumbs-up"></span>&nbsp
                <span class="badge">{{ $post->likes->count() }}</label>
            </button>
            </div>
        </form>

    @else

        <form action="{{ url('/likes') }}" method="POST">               
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="clearfix">
            <button type="submit" class="btn btn-primary btn-xs pull-right">
                Odlub
                <span class="glyphicon glyphicon-thumbs-up"></span>&nbsp
                <span class="badge">{{ $post->likes->count() }}</label>
            </button>
            </div>
        </form>

    @endif
@endif