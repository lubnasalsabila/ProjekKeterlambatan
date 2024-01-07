@extends('layouts.nav')

@section('content')
<div class="col-md-9 offset-md-3">
    <h3>Tambah Data Siswa</h3>
    <p>Data Siswa / Tambah Data Siswa / Edit Data Siswa</p>

    <form action="{{ route('terlambat.admin.siswa.update', $siswas->id) }}" method="post" class="card p-5">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">Nis</label>
            <div class="col-sm-10">
                <input type="text" name="nis" id="nis" class="form-control" value="{{ $siswas->nis }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" name="name" id="name" class="form-control" value="{{ $siswas->name }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rombel_id" class="col-sm-2 col-form-label" >Rombel</label>
            <div class="col-sm-10">
                <select name="rombel_id" id="rombel_id" class="form-select">
                    @foreach ($rombels as $item)
                        <option value="{{ $item->id }}" {{ $item->id === $siswas->rombel_id ? 'selected' : '' }}>{{ $item->rombel }}</option>
                    @endforeach
                </select>
            </div>
        </div>
                    @foreach ($users as $item)
                        <option value="{{ $item->id }}" {{ $item->id === $rayons->user_id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
        <div class="mb-3 row">
            <label for="rayon_id" class="col-sm-2 col-form-label" >Rayon</label>
            <div class="col-sm-10">
                <select name="rayon_id" id="rayon_id" class="form-select">
                    @foreach ($rayons as $item)
                        <option value="{{ $item->id }}" {{ $item->id === $siswas->rayon_id ? 'selected' : '' }}>{{ $item->rayon }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-lg btn-primary" style="width:130px;">Edit</button>
    </form>
</div>
@endsection