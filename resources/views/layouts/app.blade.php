<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Laravel App - @yield("title")</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="#">Blog Post</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route("home.index") }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route("home.contact") }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route("posts.index") }}">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route("posts.create") }}">Create Post</a>
                </li>
       

                @guest
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ route("register") }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ route("login") }}">Login</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout ({{ Auth::user()->name }})</a>
                    </li>

                    <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none">
                        @csrf
                    </form>
                @endguest
            </ul>
          </div>
        </div>
      </nav>

    <div class="container">   
        @if (session("status"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("status") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @yield("content")
    </div>
</body>
</html>