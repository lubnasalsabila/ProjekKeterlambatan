<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Web-Keterlambatan</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container" style="margin-left: 300px;">
                <a class="navbar-brand" style="font-size: 20px;" href="{{-- route('home') --}}">Rekam Keterlambatan</a>
            </div>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <div class="d-flex justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/img/user.png" alt="user" style="width: 20px;">
                                {{ Auth::user()->name }}
                            </a>
                            @if (Auth::check())
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    </div>
                </ul>
            </div>
        </nav>
        @if(Auth::user()->role == 'Administrator')
        <div class="side-bar">
          <div class="nav-links">
              <div class="nav-link-wrapper"><img src="/img/dashboard.png" alt="" style="width: 20px;"><a href="{{ route('home') }}">Dashboard</a></div><br>
              <div class="nav-link-wrapper dropdown"><img src="/img/database.png" alt="" style="width: 20px;">
                <a href="#" class="dropdown-toggle" id="dataMasterDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data Master</a>
                <div class="dropdown-menu" aria-labelledby="dataMasterDropdown">
                    <a class="dropdown-item" href="{{ route('terlambat.admin.rombel.index') }}">Data Rombel</a>
                    <a class="dropdown-item" href="{{ route('terlambat.admin.rayon.index') }}">Data Rayon</a>
                    <a class="dropdown-item" href="{{ route('terlambat.admin.siswa.index') }}">Data Siswa</a>
                    <a class="dropdown-item" href="{{ route('terlambat.admin.user.index') }}">Data User</a>
                </div>
            </div><br>
              <div class="nav-link-wrapper"><img src="/img/writing.png" alt="" style="width: 20px;"><a href="{{ route('terlambat.admin.keterlambatan.index') }}">Data Keterlambatan</a></div><br>
          </div>
        </div>
        @else
        <div class="side-bar">
            <div class="nav-links">
                <div class="nav-link-wrapper"><img src="/img/dashboard.png" alt="" style="width: 20px;"><a href="{{ route('home') }}">Dashboard</a></div><br>
                <div class="nav-link-wrapper"><img src="/img/database.png" alt="" style="width: 20px;"><a href="{{ route('terlambat.ps.student') }}">Data Siswa</a></div><br>
                <div class="nav-link-wrapper"><img src="/img/writing.png" alt="" style="width: 20px;"><a href="{{ route('terlambat.ps.index') }}">Data Keterlambatan</a></div><br>
            </div>
          </div>
        @endif
        @endif
    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Include Bootstrap's bundle (includes Popper.js) before Bootstrap's JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- ... -->
    @stack('script')
</body>
</html>


