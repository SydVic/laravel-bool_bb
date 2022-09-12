@extends('layouts.dashboard')

@push('css')
  <link rel="stylesheet" href="{{ asset('css/apartment-messages-navbar.css') }}">
@endpush

@section('content')

  <div id="root">

    <message-main
    :user-messages="{{ $user_messages }}"
    :user-apartments="{{ $user_apartments }}"
    >
    </message-main>

  </div>

<script src="{{ asset('js/front.js') }}"></script>

@endsection