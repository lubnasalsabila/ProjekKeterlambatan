@extends('layouts.nav')

@section('content')
<div class="col-md-9 offset-md-3">
    <h3>Edit Data Keterlambatan</h3>
    <p>Data Keterlambatan / Tambah Data Keterlambatan / Edit Data Keterlambatan</p>

    <form action="{{ route('terlambat.admin.keterlambatan.update', $lates->id) }}" method="post" class="card p-5" enctype="multipart/form-data">
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
            <label for="student_id" class="col-sm-2 col-form-label">Siswa</label>
            <div class="col-sm-10">
                <select name="student_id" id="student_id" class="form-select">
                    @foreach ($siswas as $item)
                        <option value="{{ $item->id }}" {{ $item->id === $lates->student_id ? 'selected' : '' }}>{{ $item->nis }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="date_time_late" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
                <input type="datetime-local" name="date_time_late" id="date_time_late" class="form-control" value="{{ $lates->date_time_late }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-label" >Keterangan keterlambatan</label>
            <div class="col-sm-10">
                <textarea type="text" name="information" id="information" class="form-control" >{{ $lates->information }}</textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="preview-bukti" class="col-sm-2 col-form-label" >Bukti</label>
            <div class="col-sm-10">
                <input type="file" name="bukti" id="bukti" class="form-control" value="{{ asset('storage/'. $lates->bukti) }}" onchange="previewImage(this)">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="preview-bukti" class="col-sm-2 col-form-label" ></label>
            <div class="col-sm-10">
               <img id="preview-bukti" src="{{ asset('storage/'. $lates->bukti) }}" alt="preview-bukti" width="100px">
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-lg btn-primary" style="width:130px;">Edit</button>
    </form>
    <script>
        function previewImage(input) {
            var preview = document.getElementById('preview-bukti');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</div>
@endsection