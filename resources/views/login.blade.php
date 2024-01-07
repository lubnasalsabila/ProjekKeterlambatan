{{-- @extends('layouts.nav') --}}
{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<center>
<div class="content" style="padding-top: 20px; width: 30rem;">
    <div class="card">
        <center><img src="/img/permission.png" class="card-img-top" alt="..." style="width: 250px;"></center>
        <div class="card-body">
          <h5 class="card-title">Login</h5>
            <form action="{{ route('login.auth') }}" method="post">
                @csrf
                @if (Session::get('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif
                @if (Session::get('logout'))
                    <div class="alert alert-primary">{{ Session::get('logout') }}</div>
                @endif
                @if (Session::get('canAccess'))
                    <div class="alert alert-danger">{{ Session::get('canAccess') }}</div>
                @endif
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">LOGIN</button>
            </form>
        </div>
    </div>
</div> 
</center>
</body>
</html>
{{-- @endsection --}}