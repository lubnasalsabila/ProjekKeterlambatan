@extends('layouts.nav')

@section('content')

<div class="col-md-9 offset-md-3">
    <h3>Tambah Rayon</h3>
    <p>Data Rayon / Tambah Data Rayon</p>
    <form action="{{ route('terlambat.admin.rayon.store') }}" class="card p-5" method="post">
        @csrf
        {{-- validasi error message --}}
        @if ($errors->any())
        <ul class="alert alert-danger p-3">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        @if (Session::has('failed'))
        <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif

        <div class="mb-3 row">
            <label for="rayon" class="col-sm-2 col-form-label">Rayon</label>
            <div class="col-sm-10">
                <input type="text" name="rayon" id="rayon" class="form-control">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label">Pembimbing Siswa</label>
            <div class="col-sm-10">
                <select name="user_id" id="user_id" class="form-select">
                    <option selected hidden disabled>Pilih Pembimbing Siswa</option>
                    @foreach ($users as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-lg btn-primary" style="width:130px;">Tambah</button>
    </form>
</div>
@endsection