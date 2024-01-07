@extends('layouts.nav')

@section('content')
  <div class="col-md-9 offset-md-3">
      <div class="container text-center">
        <div class="row">
          @php $no = 1; @endphp
          @foreach ($lates as $card)
          <div class="col">
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                    <h5 class="card-title">keterlambatan ke- {{ $no++ }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $card->date_time_late }}</h6>
                    <p class="card-text">{{ $card->information }}</p>
                    <img id="bukti" src="{{ asset('storage/' .$card->bukti) }}" alt="buktiii" style="width: 100px;">
                  </div>
                </div>
                <br>
              </div>
          @endforeach
            </div>
      </div>
  </div>
@endsection