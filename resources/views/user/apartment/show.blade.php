@extends('layouts.dashboard')

@push('css')
  <link rel="stylesheet" href="{{ asset('css/apartment-card-detailed-backend.css') }}">
@endpush

@section('content')
  @if(session('message'))
    <div class="alert alert-success position-absolute top-50 start-50 translate-middle px-5">
      {{ session('message') }}
    </div>
  @endif

  <div class="container-fluid d-flex justify-content-center">

    <div class="card-wrapper-detailed">
      <div class="row">

        <div class="col-xl-3 col-lg-4 col-md-12">

          <div class="img-wrapper-detailed">
            <img class="detailed" src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }}">
          </div>

        </div>

        <div class="col-xl-9 col-lg-8 col-md-12">
          <div class="content-wrapper text-grey p-3 d-flex flex-column justify-content-center">
            <h4>
              <span class="text-primary">Titolo: </span> 
              {{ $apartment->title }}
            </h4>
            <p>
              <span class="text-primary">Slug: </span>
              {{ $apartment->slug }}
            </p>
            <h6>
              <span class="text-primary">Indirizzo: </span>
              {{ $apartment->address }}
            </h6>
            <div>
              <span class="text-primary">Prezzo: </span>
              <div class="d-inline-block">{{ $apartment->price }} &euro;</div>
            </div>
            @if ($apartment->description > 0)
              <p>
                <span class="text-primary">Descrizione:</span>
                {{ $apartment->descritpion }}
              </p>
            @endif
            <div>
              <span class="text-primary">Stanze: </span>
              {{ $apartment->rooms_number }}
            </div>
            <div>
              <span class="text-primary">Posti letto: </span>
              {{ $apartment->beds_number }}
            </div>
            <div>
              <span class="text-primary">Bagni: </span>
              {{ $apartment->bathrooms_number }}
            </div>
            <div>
              <span class="text-primary">Metri quadrati: </span>
              {{ $apartment->mqs }}
            </div>

            <div>
              <span class="text-primary">
                <strong>
                  Visibile agli utenti: 
                </strong>
              </span>
              @if ($apartment->visibility === 1)
                <div class="d-inline-block">
                  Si
                </div>
              @else
                <div class="d-inline-block">
                  no
                </div>
              @endif
              <p>
                <span class="text-primary">
                  Servizi :
                </span>
                @forelse ($apartment->services as $service)
                <span class="badge rounded-pill bg-success">
                  {{ $service->name }}
                </span>
                @empty
                  Nessun servizio extra  
                @endforelse
              </p>
            </div>

            <div class="buttons-wrapper">
              <span>
                <a class="btn btn-warning" href="{{ route('user.sponsor.index', ['apartment' => $apartment->id]) }}">Sponsorizza</a>
              </span>

              <span>
                <a class="btn btn-outline-success" href="{{ route('user.apartment.edit', ['apartment' => $apartment->id]) }}">Modifica dettagli</a>
              </span>

              <span>
                <a class="btn btn-outline-secondary" href="{{ route('user.message.apartment-messages', ['message' => $apartment->id]) }}">Messaggi</a>
              </span>
              
              <span>
                <a class="btn btn-outline-info" href="{{ route('user.visual.views', ['apartment' => $apartment->id]) }}">Statistiche</a>
              </span>
              
              <span>
                <a class="btn btn-outline-primary" href="{{ route('user.apartment.index') }}">Lista appartamenti</a>
              </span>

              <form action="{{ route('user.apartment.destroy', ['apartment' => $apartment->id]) }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script>

  if(document.querySelector('.alert.alert-success')){
    setTimeout(() => {
      document.querySelector('.alert.alert-success').remove();
    }, 3000);
  }
</script>
@endpush