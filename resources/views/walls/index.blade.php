@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Aktywności
                </div>
                @if(Auth::check())
                <div class="panel-body">
                    @include('posts.create')
                </div>
                @endif
            </div>

            @foreach($posts as $post)
                @include('posts.single')
            @endforeach
            <div class="col-md-12 text-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection