@extends('layouts.dashboard')

@push('css')
  <link rel="stylesheet" href="{{ asset('css/apartment-messages-navbar.css') }}">
@endpush

@section('content')
{{-- {{dd(request()->query('sidebar'))}} --}}
    <div class="container-fluid">
    {{-- ROW  --}}
      <div class="row">

        {{-- COL  --}}
        <div class="{{ request()->query('sidebar') ? 'col-md-9' : 'col-md-12' }}">
          <div class="conteiner-fluid d-flex justify-content-start flex-wrap">

            @foreach ($messages as $message)
            <div class="card m-2" style="width: 18rem;">
              <div class="card-body">
                <p>Messaggio ricevuto il: {{ $message->created_at->format('d m Y') }}</p>
                <h5 class="card-title">{{ $message->apartment->address }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $message->email }}</h6>
                <p class="card-text">{{ $message->text}}</p>
                <div class="text-center">
                  <a href="{{ route('user.message.show', ['message' => $message->id]) }}" class="btn btn-primary text-light">Leggi il messaggio completo</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        {{-- /COL  --}}

        @if (request()->query('sidebar'))
        {{-- COL --}}
        <div class="col-md-3">
          <p>Filtra i messaggi per appartamento</p>
          <div class="apartments-list">
            <ul class="list-group">
              @foreach ($user_apartments as $apartment)
              <li class="list-group-item list-group-item-action mb-3">
                <a href="{{ route('user.message.apartment-messages', ['message' => $apartment->id, 'sidebar' => true]) }}">
                  <div class="row">
                    <div class="col-md-8">
                      <p>{{ $apartment->title }}</p>
                      <p>{{ $apartment->address }}</p>
                    </div>
                    <div class="col-md-4">
                      <div class="img-wrap">
                        @if (str_contains($apartment->image, 'picsum'))
                        <img id="navbar-img" src="{{ $apartment->image }}" alt="{{ $apartment->title }}">
                        @else
                        <img id="navbar-img"  src="{{ asset('storage/' . $apartment->image ) }}" alt="{{ $apartment->title }}">
                        @endif
                      </div>
                    </div>
                  </div>
                </a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
        {{-- /COL --}}
        @endif
        
      </div>
      {{-- /ROM  --}}
      @endsection
    </div>