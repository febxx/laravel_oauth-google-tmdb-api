@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @auth
        <div class="card text-white bg-primary mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5>{{Auth::user()->name}}</h5>
                        <p>{{Auth::user()->email}}</p>
                    </div>
                    <div class="col text-end">
                        <a class="btn btn-light" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="text-center">Trending Movies</h3>
        <div class="card">
            <div class="card-body">
                <div class="row">
                @if($data)
                    @foreach($data['results'] as $item)
                    <div class="col-md-3 mb-2">
                        <a href="/movie/{{$item['id']}}" class="text-decoration-none">
                            <div class="card">
                                <img class="card-img-top"
                                    src="https://www.themoviedb.org/t/p/w220_and_h330_face{{ $item['poster_path'] }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$item['title']}}</h5>
                                    <p class="card-text text-dark">{{$item['overview']}}</p>
                                    <p class="card-text"><small class="text-muted">Release Date:
                                            {{$item['release_date']}}</small></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                @else
                    <div class="alert alert-danger">API tidak respons</div>
                @endif
                </div>
            </div>
        </div>
        @else
        <div class="form-group row mb-4 justify-content-center text-center">
            <div class="col-md-12">
                <a href="{{ url('/auth/google') }}" class="btn btn-dark"><i class="fa-brands fa-google"></i> Log in with
                    Google</a>
                <a href="{{ url('/auth/facebook') }}" class="btn btn-primary"><i class="fa-brands fa-facebook"></i> Log
                    in with Facebook</a>
            </div>
        </div>
        <h3 class="text-center">Trending Movie</h3>
        <div class="alert alert-danger">Login untuk melihat data</div>
        @endauth

    </div>
</div>
@endsection
