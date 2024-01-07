@extends('layouts.nav')

@section('content')
<div class="col-md-9 offset-md-3">
    @if(Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if(Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    @if(Session::get('gagal'))
        <div class="alert alert-warning">{{ Session::get('gagal') }}</div>
    @endif
    <div class="title">
      <h5>Data Rayon</h5>
    </div>
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-secondary" href="{{ route('terlambat.admin.rayon.create') }}">Tambah Rayon</a>
    </div>
    <form action="{{ route('terlambat.admin.rayon.index') }}" method="get" class="mb-3">
      <div class="input-group" style="width: 300px;">
          <input type="text" class="form-control" name="query" value="{{ $query }}" placeholder="Cari...">
          <button class="btn btn-outline-secondary" type="submit">Cari</button>
      </div>
    </form>
    <table class="table ">
        <thead>
            <tr>
                <th>No</th>
                <th>Rayon</th>
                <th>Pembimbing Rayon</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($rayons as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['rayon'] }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('terlambat.admin.rayon.edit',$item['id']) }}" class="btn btn-primary me-3">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#edit-stock-{{ $item['id'] }}">
                            Hapus
                          </button>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    @if ($rayons->count())
    {{ $rayons->links() }}
    @endif 
    @foreach ($rayons as $item)
    <div class="modal" tabindex="-1" id="edit-stock-{{ $item['id'] }}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Konfirmasi Hapus</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Yakin ingin menghapus data rayon ini? </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <form action="{{ route('terlambat.admin.rayon.delete', $item['id']) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Hapus</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @endforeach
</div>
@endsection