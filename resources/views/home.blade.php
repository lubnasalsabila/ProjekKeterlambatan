@extends('layouts.nav')

@section('content')
<div class="col-md-9 offset-md-3">
  <div class="title">
    <h5>Dashboard</h5>
    <p>Home</p>
  </div>
  <br>
  <div class="container" >
    <div class="row row-cols-2">
      <div class="col">
        <div class="card" style="margin-bottom: 23px;">
          <div class="card-body" style="background-color: #D2E3C8;">
            <b><span>Peserta Didik</span></b>
            <div class="d-flex align-items-end">
              <img src="/img/user.png" alt="" width="40px">
              <h4 style="padding-left: 10px; "><b>{{ App\Models\Student::where('name', '!=', '')->count() }}</b></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-body"style="background-color: #D2E3C8;">
                  <b><span>Administrator</span></b>
                  <div class="d-flex align-items-end">                  
                    <img src="/img/user.png" alt="" width="40px">
                    <h4 style="padding-left: 10px;"><b>{{ App\Models\User::where('role', 'Administrator')->count() }}</b></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-body"style="background-color: #D2E3C8;">
                  <b><span>Pembimbing Siswa</span></b>
                  <div class="d-flex align-items-end">
                    <img src="/img/user.png" alt="" width="40px">
                    <h4 style="padding-left: 10px; "><b>{{ App\Models\User::where('role', 'Pembimbing')->count() }}</b></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-body"style="background-color: #D2E3C8;">
            <b><span>Rombel</span></b>
            <div class="d-flex align-items-end">
              <img src="/img/bookmark.png" alt="" width="40px">
              <h4 style="padding-left: 10px; "><b>{{ App\Models\Rombel::where('rombel', '!=', '')->count() }}</b></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-body"style="background-color: #D2E3C8;">
            <b><span>Rayon</span></b>
            <div class="d-flex align-items-end">
              <img src="/img/bookmark.png" alt=""width="40px">
              <h4 style="padding-left: 10px; "><b>{{ App\Models\Rayon::where('rayon', '!=', '')->count() }}</b></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection