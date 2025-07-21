@extends('layouts.layout')

@section('style')
<style>
.custom-navbar {
    height: 70px;
}

.custom-navbar .navbar-brand,
.custom-navbar .nav-link {
    line-height: 100px;
    font-size: 20px;
}

</style>

@endsection

@section('body')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark custom-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MiniSocial</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('posts.index') ? 'active text-light text-decoration-underline' : '' }}" href="{{ route('posts.index') }}">
            Home
        </a>

        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('user.index') ? 'active text-light text-decoration-underline' : '' }}" href="{{ route('user.index') }}">
            Profile
        </a>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('logout')}}">Logout</a>
        </li>
      </ul>
    </div>
    <ul class="navbar-nav ms-auto me-3">
        @if(Auth::check())
            <li class="nav-item">
                <a class="nav-link" href="#" style="font-size: 17px;">
                    Welcome, {{ Auth::user()->name }} !!
                </a>
            </li>
        @endif
    </ul>
  </div>
</nav>
@yield('content')
@endsection
