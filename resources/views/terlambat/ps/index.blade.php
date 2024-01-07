@extends('layouts.nav')

@section('content')
<div class="col-md-9 offset-md-3">
    <div class="title">
      <h5>Data Keterlambatan</h5>
    </div>
    <div class="excel">
      <a href="{{ route('terlambat.ps.export') }}" class="btn btn-success">Export Data</a>
    </div>
    <br>
    <form action="{{ route('terlambat.ps.index') }}" method="get" class="mb-3">
      <div class="input-group" style="width: 300px;">
          <input type="text" class="form-control" name="query" value="{{ $query }}" placeholder="Cari...">
          <button class="btn btn-outline-secondary" type="submit">Cari</button>
      </div>
    </form>
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#tabel1">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('terlambat.ps.rekap') }}">Rekapitulasi Data</a>
        </li>
      </ul>
<div id="tabel1">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Tanggal</th>
                <th>Informasi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($lates as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->student->nis}}</td>
                    <td>{{ $item['date_time_late']}}</td>
                    <td>{{ $item['information']}}</td>
                </tr>
                @endforeach
        </tbody>
    </table>
    @if ($lates->count())
    {{ $lates->links() }}
    @endif 
</div>
@endsection