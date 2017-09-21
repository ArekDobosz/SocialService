@if($loop->first)

@else
    <hr>
@endif
<div id="comment_{{ $comment->id }}">
    <div class="single-comment {{ $comment->trashed() ? 'trashed' : '' }}">
        <div class="row">
            <div class="pull-right">
                @if(has_permission_to_edit($comment->author_id) || is_admin())
                    @include('comments.dropdown')
                @endif
            </div>
            <div class="col-md-1">
                <img src="{{ url('avatars/'.$comment->author->id.'/30') }}" alt="avatar">
            </div>
            <div class="col-md-11">
                <a href="{{ url('users/'.$comment->author->id) }}">{{ $comment->author->name }}</a> | <small>{{ $comment->created_at }}</small>
                @include('comments.add_like')
            </div>
            <div class="col-md-12">
                <em>{{ $comment->content }}</em>
            </div>
        </div>
    </div>
</div>