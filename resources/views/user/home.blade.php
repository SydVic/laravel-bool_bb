@extends('layouts.dashboard')

@section('content')
    <div class="container text-light">
        <div class="mt-2">
            @if ($user->name && $user->lastname)
                Ciao {{$user->name}} {{ $user->lastname }}
            @else
                Sei loggato con {{ $user->email }}
            @endif
        </div>
        <p class="mt-2">Da questa pagina puoi gestire i tuoi appartamenti:</p>
        <ul>
            <li>Puoi aggiungere nuovi appartamenti o modificare quelli esistenti.</li>
            <li>Visualizzare i messaggi ricevuti.</li>
            <li>Visualizzare le statistiche per i tuoi appartamenti.</li>
            <li>Sponsorizzare i tuoi appartamenti</li>
        </ul>

    </div>
@endsection
