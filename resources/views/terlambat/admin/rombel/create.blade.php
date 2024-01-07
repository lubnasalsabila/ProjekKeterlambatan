@extends('layouts.nav')

@section('content')

    <div class="col-md-9 offset-md-3">
        <h3>Tambah Rombel</h3>
        <p>Data Rombel / Tambah Data Rombel</p>       
        <form action="{{ route('terlambat.admin.rombel.store') }}" class="card p-5" method="post">
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
                <label for="rombel" class="col-sm-2 col-form-label">Rombel</label>
                <div class="col">
                    <input type="text" name="rombel" id="rombel" class="form-control">
                </div>
            </div>
    
            <button type="submit" class="btn btn-block btn-lg btn-primary"style="width:130px;">Tambah</button>
        </form>
    </div>
@endsection
