@extends('layouts.nav')

@section('content')

<div class="col-md-9 offset-md-3">
    <h3>Tambah Data Keterlambatan</h3>
    <p>Data Keterlambatan / Tambah Data Keterlambatan </p>
    <form action="{{ route('terlambat.admin.keterlambatan.store') }}" class="card p-5" method="post" enctype="multipart/form-data">
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
            <label for="student_id" class="col-sm-2 col-form-label">Siswa</label>
            <div class="col-sm-10">
                <select name="student_id" id="student_id" class="form-select">
                    <option selected hidden disabled>Pilih Siswa</option>
                    @foreach ($siswas as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="date_time_late" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
                <input type="datetime-local" name="date_time_late" id="date_time_late" class="form-control">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-label">Keterangan keterlambatan</label>
            <div class="col-sm-10">
                <textarea type="text" name="information" id="information" class="form-control"></textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-label">Bukti</label>
            <div class="col-sm-10">
                <input type="file" name="bukti" id="bukti" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-lg btn-primary" style="width:130px;">Tambah</button>
    </form>
</div>
@endsection