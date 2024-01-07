@extends('layouts.nav')

@section('content')
<div class="col-md-9 offset-md-3">
    <div class="title">
      <h5>Data Siswa</h5>
    </div>
    <form action="{{ route('terlambat.ps.student') }}" method="get" class="mb-3">
      <div class="input-group" style="width: 300px;">
          <input type="text" class="form-control" name="query" value="{{ $query }}" placeholder="Cari...">
          <button class="btn btn-outline-secondary" type="submit">Cari</button>
      </div>
    </form>
    <table class="table ">
        <thead>
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Rayon</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($siswas as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['nis'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item->rombel->rombel }}</td>
                    <td>{{ $item->rayon->rayon}}</td>
                </tr>
                @endforeach
        </tbody>
    </table>
    @if ($siswas->count())
    {{ $siswas->links() }}
    @endif 
</div>
@endsection