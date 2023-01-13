@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
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
    <div class="card">
      <div class="card-body">
        <div class="row">
            <div class="col-4">
                <img class="w-100" src="https://www.themoviedb.org/t/p/w220_and_h330_face{{ $data['poster_path'] }}">
            </div>
            <div class="col-8">
                <table class="table">
                    <tr>
                        <td>Title</td>
                        <td>: {{$data->title}}</td>
                    </tr>
                    <tr>
                        <td>Overview</td>
                        <td>: {{$data->overview}}</td>
                    </tr>
                    <tr>
                        <td>Release Date</td>
                        <td>: {{$data->release_date}}</td>
                    </tr>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
