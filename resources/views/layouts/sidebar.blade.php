<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            Dane użytkownika
            @if($user->id == Auth::id())
                <a href="{{ url('/users/'.$user->id.'/edit') }}" class="pull-right"><small>edytuj</small></a>
            @endif
        </div>

        <div class="panel-body text-center">
            <h2><a href="{{ url('/users/'.$user->id) }}">{{ $user->name }}</a></h2>
            <img src="{{ url('/avatars/'.$user->id.'/400') }}" alt="avatar" class="thumbnail img-responsive">
            <p>
            @if($user->sex == 'f')
                Kobieta
            @else
                Mężczyzna
            @endif
            </p>
            <p>{{ $user->email }}</p>

                @if(Auth::check() && Auth::id() !== $user->id)
                    <div class="col-md-12">
                    @if(!friendship($user->id)->exists && !has_already_friends($user->id))

                    <form action="{{ url('/friends/'.$user->id) }}" method="POST" name="friendAdd">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success">Zaproś do znajomych</button>
                    </form>

                    @elseif(has_friend_invitation($user->id)) 
                        
                    <form action="{{ url('/friends/'.$user->id) }}" name="friendAccept" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <button type="submit" class="btn btn-info">Przyjmij zaproszenie</button>
                    </form>

                    @elseif (friendship($user->id)->exists && !friendship($user->id)->accepted)                   
                        <button class="btn btn-success disabled">Zaprosznie wysłane</button>

                    @elseif(friendship($user->id)->exists && friendship($user->id)->accepted) 
                    <div class="alert alert-success">Jesteście już znajomymi</div>

                    <form action="{{ url('/friends/'.$user->id) }}" name="friendAccept" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Usuń ze znajomych</button>
                    </form>
                    @endif
                    </div>
                    <!-- {{ var_dump(friendship($user->id)) }} -->
                @endif
                <div class="col-md-6 col-md-offset-3 friendsList">
                    <a href="{{ url('/users/'.$user->id.'/friends') }}">
                        Lista znajomych
                    </a>
                    <span class="label label-primary">
                        {{ $user->friends()->count() }}
                    </span>
                </div>
        </div>  
    </div>
</div>