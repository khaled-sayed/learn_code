<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
    <div class="container-fluid">

    <a class="navbar-brand" href="/"><span class="logo">LC</span> Learncode</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse links" id="navbarSupportedContent">
        <form action="/search" method="GET" class="form-inline my-2 my-lg-0 search-form">
        <input name="q" placeholder="find your course..." class="form-control mr-sm-2" type="search" aria-label="Search">
    </form>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
            @auth
                <a class="nav-link @auth dropdown-toggle @endauth" href="/login" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{\Str::limit(auth()->user()->name, 10)}}
                </a>
            @endauth
            @guest
                <a class="nav-link" href="/login">Login</a>
            @endguest
            @auth
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/profile">Profile</a>
                    <a class="dropdown-item" href="/mycourses">My Courses</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </div>
            @endauth
        </li>
    </ul>

  </div>
</div>
</nav>
