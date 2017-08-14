@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading text-center">Edycja danych</div>
                <div class="panel-body">
                    <div class="col-sm-10 col-sm-offset-1">
                        <form action="{{ url('/users/'.$id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">                               
                                <label for="">Imię i Nazwisko</label>
                                <input name="name" type="text" class="form-control" value="{{ $user->name }}">                              
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input name="email" type="email" class="form-control" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <select name="sex" class="form-control">
                                    <option value="f" @if($user->sex == 'f') selected @endif>Kobieta</option>
                                    <option value="m" @if($user->sex == 'm') selected @endif>Mężczyzna</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success pull-right">Zapisz zmiany</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
