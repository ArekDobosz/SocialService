@if(Auth::check())
    @if(!Auth::user()->likes->contains('comment_id', $comment->id))

        <form action="{{ url('/likes') }}" method="POST">               
            {{ csrf_field() }}
            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
            <div class="clearfix">
                <button type="submit" class="btn btn-primary btn-xs pull-right">
                    Polub
                    <span class="glyphicon glyphicon-thumbs-up"></span>&nbsp
                    <span class="badge">{{ $comment->likes->count() }}</label>
                </button>
            </div>
        </form>

    @else
        Lubisz!
        <form action="{{ url('/likes') }}" method="POST">               
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
            <div class="clearfix">
            <button type="submit" class="btn btn-primary btn-xs pull-right">
                Odlub
                <span class="glyphicon glyphicon-thumbs-up"></span>&nbsp
                <span class="badge">{{ $comment->likes->count() }}</label>
            </button>
            </div>
        </form>

    @endif
@endif