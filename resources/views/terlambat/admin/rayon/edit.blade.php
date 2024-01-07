@extends('layouts.nav')

@section('content')
<div class="col-md-9 offset-md-3">
    <h5>Edit Rayon</h5>
    <p>Data Rayon / Tambah Data Rayon / Edit Data Rayon</p>
    <form action="{{ route('terlambat.admin.rayon.update', $rayons->id) }}" method="post" class="card p-5">
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
            <label for="rayon" class="col-sm-2 col-form-label">Rayon</label>
            <div class="col-sm-10">
                <input type="text" name="rayon" id="rayon" class="form-control" value="{{ $rayons->rayon }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="ps" class="col-sm-2 col-form-label" >Pembimbing Siswa</label>
            <div class="col-sm-10">
                <select name="user_id" id="user_id" class="form-select">
                    @foreach ($users as $item)
                        <option value="{{ $item->id }}" {{ $item->id === $rayons->user_id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-lg btn-primary" style="width:130px;">Edit</button>
    </form>
</div>
@endsection