@extends('layouts.app')

@section('search')
    value="{{ $search }}"
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        Wyniki wyszukiwania
                    </div>
                    <div class="panel-body text-center">
                        @if($users->count() === 0)
                            Brak wyników do wyświetlenia
                        @else
                        <div class="row">
                            @foreach($users as $user)
                                <div class="col-md-4 text-center">
                                    <a href="{{ url('/users/'.$user->id) }}">
                                        <div class="thumbnail">
                                        <img src="{{ url('/avatars/'.$user->id.'/175') }}" class="img-responsive">
                                            <h4>{{ $user->name }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            <div class="col-md-12 text-center">
                                {{ $users->appends(['q' => $search])->links() }}
                            </div>
                        </div>
                        @endif 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection