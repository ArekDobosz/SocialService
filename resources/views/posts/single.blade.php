<div class="panel panel-default">
    <div class="panel-body">

    @if(Auth::check() && Auth::id() === $post->user_id)
        @include('posts.dropdown')
    @endif

        <div class="clearfix">
            <img src="{{ url('avatars/'.$post->user->id.'/50') }}" class="img-responsive pull-left"  alt="avatar">
            <div class="pull-left">
                <a href="{{ url('users/'.$post->user->id) }}">{{ $post->user->name }}</a><br>
                <a href="{{ url('posts/'.$post->id) }}" class="text-muted"><small>{{ $post->created_at }}</small></a>
            </div>
        </div>

        <div class="post_{{ $post->id }}">
            {{ $post->content }}
        </div>
        
    </div>
</div>