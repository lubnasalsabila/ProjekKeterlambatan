@extends('layouts.nav')

@section('content')
<div class="col-md-9 offset-md-3">
    <h5>Edit Rombel</h5>
    <p>Data Rombel / Tambah Data Rombel / Edit Data Rombel</p>
    <form action="{{ route('terlambat.admin.rombel.update', $rombels->id) }}" method="post" class="card p-5">
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
            <label for="rombel" class="col-sm-2 col-form-label">Rombel</label>
            <div class="col-sm-10">
                <input type="text" name="rombel" id="rombel" class="form-control" value="{{ $rombels->rombel }}">
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-lg btn-primary" style="width:130px;">Edit</button>
    </form>
</div>
@endsection