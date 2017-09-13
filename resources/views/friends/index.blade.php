@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        Lista znajomych
                        <span class="label label-primary">
                            {{ $friends->count() }}
                        </span>
                    </div>
                    <div class="panel-body text-center">
                        @if($friends->count() === 0)
                            Brak znajomych na liscie
                        @else
                        <div class="row">
                            @foreach($friends as $friend)
                                <div class="col-md-4 text-center">
                                    <a href="{{ url('/users/'.$friend->id) }}">
                                        <div class="thumbnail">
                                        <img src="{{ url('/avatars/'.$friend->id.'/175') }}" class="img-responsive">
                                            <h4>{{ $friend->name }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            <div class="col-md-12 text-center">
                            </div>
                        </div>
                        @endif 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection