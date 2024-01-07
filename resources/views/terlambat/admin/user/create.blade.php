@extends('layouts.nav')

@section('content')

    <div class="col-md-9 offset-md-3">
        <h3>Tambah Data User</h3>
        <p>Data User / Tambah Data User</p>
        <form action="{{ route('terlambat.admin.user.store') }}" class="card p-5" method="post">
            @csrf
            {{-- validasi error message --}}
            @if ($errors->any())
                <ul class="alert alert-danger p-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            @if (Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
            @endif
            
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label" >Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" id="email" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <select name="role" id="role" class="form-control">
                        <option value="Administrator">Administator</option>
                        <option value="Pembimbing">Pembimbing Siswa</option>
                    </select>
                </div>  
            </div>
            <div class="mb-3 row">
                <label for="pass" class="col-sm-2 col-form-label" >Password</label>
                <div class="col-sm-10">
                    <input type="password" name="pass" id="pass" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-lg btn-primary"style="width:130px;">Create</button>
        </form>
    </div>
@endsection
