@extends('layouts.dashboard')

@section('content')
  <div class="container d-flex justify-content-center flex-wrap">
    <div class="card mt-5">
      <div class="card-body">
        <h5 class="card-title">Indirizzo appartemento: {{ $message->apartment->address }}</h5>
        @if ($message->user_name)
            <h6 class="card-title">Messaggio da: {{ $message->user_name . ' ' . $message->user_lastname }}</h6>
        @endif
        <h6 class="card-subtitle mb-2 text-muted">Email: {{ $message->email }}</h6>
        <p class="card-text">{{ $message->text}}</p>
        <div class="text-center">
          <a class="btn btn-primary text-light" href="{{ route('user.message.apartment-messages', ['message' => $message->apartment->id]) }}">Torna ai messaggi per questo appartamento</a>
        </div>
      </div>
    </div>
  </div>
@endsection