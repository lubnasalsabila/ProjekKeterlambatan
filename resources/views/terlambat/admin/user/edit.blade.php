@extends('layouts.nav')

@section('content')
<div class="col-md-9 offset-md-3">
    <h3>Edit Data User</h3>
    <p>Data User / Tambah Data User / Edit Data User</p>
    <form action="{{ route('terlambat.admin.user.update', $users['id']) }}" method="post" class="card p-5">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama : </label>
            <div class="col-sm-10">
                <input type="text" name="name" id="name" class="form-control" value="{{ $users['name'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email : </label>
            <div class="col-sm-10">
                <input type="text" name="email" id="email" class="form-control" value="{{ $users['email'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Role : </label>
            <div class="col-sm-10">
               <select name="role" id="role" class="form-select">
                    <option selected disabled hidden>Pilih</option>
                    <option value="Administrator" {{ $users['role'] == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                    <option value="Pembimbing" {{ $users['role'] == 'Pembimbing' ? 'selected' : '' }}>Pembimbing Siswa</option>
               </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="pass" class="col-sm-2 col-form-label">Password : </label>
            <div class="col-sm-10">
                <input type="password" name="pass" id="pass" class="form-control" value="{{ $users['pass'] }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
</div>
@endsection