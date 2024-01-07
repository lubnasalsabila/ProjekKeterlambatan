@extends('layouts.nav')

@section('content')
<div class="col-md-9 offset-md-3">
    @if(Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if(Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    <div class="title">
      <h5>Data Keterlambatan</h5>
    </div>
    <div class="d-flex justify-content-end mb-3">
      <a class="btn btn-secondary" href="{{ route('terlambat.admin.keterlambatan.create') }}">Tambah Data Keterlambatan</a>
    </div>
    <form action="{{ route('terlambat.admin.keterlambatan.rekap') }}" method="get" class="mb-3">
      <div class="input-group" style="width: 300px;">
          <input type="text" class="form-control" name="query" value="{{ $query }}" placeholder="Cari...">
          <button class="btn btn-outline-secondary" type="submit">Cari</button>
      </div>
    </form>
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('terlambat.admin.keterlambatan.index') }}">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Rekapitulasi Data</a>
        </li>
      </ul>
<div id="tabel1">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Jumlah keterlambatan</th>
                <th>  </th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            @php
            $lateCounts = [];
            @endphp
            @foreach ($lates as $late)
                @php
                $studentId = $late->student->id;
                if(!isset ($lateCounts[$studentId])) {
                    $lateCounts[$studentId] = 1;
                } else {
                    $lateCounts[$studentId] += 1;
                }
                @endphp
            @endforeach
            @php $no = 1; @endphp
            @foreach ($lateCounts as $studentId => $count)
                @php
                $late = $lates->firstWhere('student.id', $studentId);
                @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $late->student->nis}}</td>
                    <td>{{ $late->student->name}}</td>
                    <td>{{ $count}}</td>
                    <td><a href="{{ route('terlambat.admin.keterlambatan.lihat', $late->student_id) }}">Lihat</a></td>
                    <td>
                      @foreach($lates as $late)
                      <div class="pdf">
                        @if($count === 3)
                        <a href="{{ route('terlambat.admin.keterlambatan.print',$late->id) }}" class="btn btn-primary" onclick="setTanggal()">Cetak surat pernyataan</a>
                        @break
                        @endif
                      </div>
                      @endforeach
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    @if ($lates->count())
    {{ $lates->links() }}
    @endif 
</div>
@endsection
<script src="{{ asset('js/tanggal-pdf.js') }}"></script>