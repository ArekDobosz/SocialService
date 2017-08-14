@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
                    <p>
                    @if($user->sex == 'f')
                        Kobieta
                    @else
                        Mężczyzna
                    @endif
                    </p>
                    <p>{{ $user->email }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default text-center">
                <div class="panel-heading">Aktywności</div>

                <div class="panel-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection