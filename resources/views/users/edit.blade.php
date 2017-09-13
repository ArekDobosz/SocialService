@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading text-center">Edycja danych</div>
                <div class="panel-body">
                    <div class="col-sm-10 col-sm-offset-1">
                    <img src="{{ url('/avatars/'.$user->id.'/200') }}" alt="avatar" class="img-responsive">
                        <form action="{{ url('/users/'.$id) }}" method="POST" enctype="multipart/form-data" novalidate>
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">                               
                                <label for="">Avatar</label>
                                <input name="avatar" type="file">
                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif                              
                            </div>

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">                               
                                <label for="">Imię i Nazwisko</label>
                                <input name="name" type="text" class="form-control" value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif                              
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="">Email</label>
                                <input name="email" type="email" class="form-control" value="{{ $user->email }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Płeć</label>
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
