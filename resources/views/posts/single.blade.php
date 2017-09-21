<div class="panel panel-default {{ $post->trashed() ? 'trashed' : ''}}">
    <div class="panel-body">

    @if(has_permission_to_edit($post->user_id) || is_admin())
        @include('posts.dropdown')
    @endif

        <div class="clearfix">
            <img src="{{ url('avatars/'.$post->user->id.'/50') }}" class="thumbnail img-responsive pull-left post-avatar"  alt="avatar">
            <div class="pull-left">
                <a href="{{ url('users/'.$post->user->id) }}">{{ $post->user->name }}</a><br>
                <a href="{{ url('posts/'.$post->id) }}" class="text-muted"><small>{{ $post->created_at }}</small></a>
            </div>
        </div>

        <div class="post_{{ $post->id }}">
            <blockquote>{{ $post->content }}</blockquote>
        </div>
        
        @include('posts.add_like')

        <hr>
        @if(Auth::check()) 
            @include('comments.create')
        @endif
        @if(count($post->comments) > 0)
        <div class="col-md-12">
            
            @foreach($post->comments as $comment)
                @include('comments.single')
            @endforeach
        </div>
        @endif

        
    </div>
</div>