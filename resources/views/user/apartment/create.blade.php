@extends('layouts.dashboard')

@push('css')
  <link rel="stylesheet" href="{{ asset('css/form-backend.css') }}">
@endpush

@section('content')
<div class="container-fluid">
  <h3 class="text-light text-center mt-2">Aggiungi un nuovo appartamento</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form class="mt-3 position-relative" action="{{ route('user.apartment.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return formSubmit()" onkeydown="return event.code !== 'Enter'">
    @csrf

    {{-- TITLE --}}
    <div class="mb-3 shadow-lg">
      <label for="title" class="form-label text-info">Titolo *</label>
      <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" >
    </div>
    {{-- /TITLE --}}

    {{-- PRICE --}}
    <div class="mb-3 shadow-lg">
      <label for="price" class="form-label text-info">Prezzo *</label>
      <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" min="0" max="9999.99" step="0.01">
    </div>
    {{-- /PRICE --}}

    {{-- DESCRIPTION --}}
    <div class="mb-3 shadow-lg">
      <label for="description" class="form-label text-info">Descrizione</label>
      {{-- TEXT area non ha attributo value quindi old() va all'interno del tag --}}
      <textarea type="text" class="form-control" id="description" name="description" rows="5" maxlength="20000">{{ old('description') }}</textarea>
    </div>
    {{-- /DESCRIPTION --}}

    {{-- ROOMS NUMBER --}}
    <div class="mb-3 shadow-lg">
      <label for="rooms_number" class="form-label text-info">Numero di stanze *</label>
      <input type="number" class="form-control" id="rooms_number" name="rooms_number" value="{{ old('rooms_number') }}" min="1" max="255">
    </div>
    {{-- /ROOMS NUMBER --}}

    {{-- BATHROOMS NUMBER --}}
    <div class="mb-3 shadow-lg">
      <label for="bathrooms_number" class="form-label text-info">Numero di bagni *</label>
      <input type="number" class="form-control" id="bathrooms_number" name="bathrooms_number" value="{{ old('bathrooms_number') }}" min="1" max="255">
    </div>
    {{-- /BATHROOMS NUMBER --}}

    {{-- BEDS NUMBER --}}
    <div class="mb-3 shadow-lg">
      <label for="beds_number" class="form-label text-info">Numero di letti *</label>
      <input type="number" class="form-control" id="beds_number" name="beds_number" value="{{ old('beds_number') }}" min="1" max="255">
    </div>
    {{-- /BEDS NUMBER --}}

    {{-- MQS --}}
    <div class="mb-3 shadow-lg">
      <label for="mqs" class="form-label text-info">Metri quadrati *</label>
      <input type="number" class="form-control" id="mqs" name="mqs" value="{{ old('mqs') }}" min="10" max="65535">
    </div>
    {{-- /MQS --}}

    {{-- ADDRESS --}}
    <div class="mb-3 position-relative">
      <label for="address" class="form-label text-info">Indirizzo *</label>
      <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" minlength="4" maxlength="255">
    </div>
    <div class="address-tips"></div>
    
    {{-- /ADDRESS --}}

    {{-- latitude --}}
    <div class="mb-3 d-none">
      <label for="latitude" class="form-label">Latitudine *</label>
      <input type="number" class="form-control" id="latitude" name="latitude" value="{{ old('latitude') }}" step="0.000001">
    </div>
    {{-- /latitude --}}

    {{-- longitude --}}
    <div class="mb-3 d-none">
      <label for="longitude" class="form-label">Longitudine *</label>
      <input type="number" class="form-control" id="longitude" name="longitude" value="{{ old('longitude') }}" step="0.000001">
    </div>
    {{-- /longitude --}}

    {{-- COVER IMAGE --}}
    <div class="mb-3">
      <label for="image-cover" class="text-info">Aggiungi un immagine *</label>
      <input type="file" id="image-cover" name="image-cover" accept=".jpg, .jpeg, .png, .bmp, .gif, .svg, .webp" class="btn btn-outline-info">
    </div>
    {{-- /COVER IMAGE --}}

    {{-- EXTRA SERVICES --}}
    <div class="extra-service">
    <p class="text-info">Servizi Extra *</p>
      <ul>
        @foreach ($extra_services as $extra_service)
        <li>
          <div class="form-check">
            <input class="form-check-input extra_services text-info" type="checkbox" value="{{ $extra_service->id }}" id="extra_service-{{ $extra_service->id }}" name="extra_services[]" {{ in_array($extra_service->id, old('extra_services', [])) ? 'checked' : '' }}>
            <label class="form-check-label text-light" for="extra_service-{{ $extra_service->id }}">
              {{ $extra_service->name }}
            </label>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
    {{-- EXTRA SERVICES --}}

    {{-- VISIBILITY --}}
    <div class="mb-3 visibility text-info">
      Vuoi rendere questo appartamento visibile nelle ricerche degli utenti?
      <div class="form-check mt-2">
        <input class="form-check-input" type="radio" name="visibility" id="visibility-true" value="1" checked>
        <label class="form-check-label" for="visibility-true">
          Si
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="visibility" id="visibility-false" value="0">
        <label class="form-check-label" for="visibility-false">
          No
        </label>
      </div>
    </div>
    {{-- /VISIBILITY --}}

    <button type="submit" class="btn btn-primary mb-5">Submit</button>
  </form>
</div>
@endsection

@push('script')
    <script src="{{ asset('js/apartmentFormValidation.js') }}" defer></script>
@endpush