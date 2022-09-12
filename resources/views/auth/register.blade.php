<?php
    function birthdateValidation() {
        $month = date("m");

        $day = date("d");

        $year = date("Y") - 18;

        $date = $year.'-'.$month.'-'.$day;

        return $date;
    }

?>
@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                {{-- REGISTRATION FORM --}}
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- NAME FIELD --}}
                        <div class="form-group row mb-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" pattern="[a-zA-Z]{2,}" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- /NAME FIELD --}}

                        {{-- LASTNAME FIELD --}}
                        <div class="form-group row mb-2">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" pattern="[a-zA-Z]{2,}" value="{{ old('lastname') }}" autocomplete="lastname" autofocus>

                                @error('Lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- /LASTNAME FIELD --}}

                        {{-- BIRTHDATE FIELD --}}
                        <div class="form-group row mb-2">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }}</label>

                            <div class="col-md-6">
                            
                                <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" max="<? birthdateValidation(); ?>" value="{{ old('birthdate') }}" autocomplete="birthdate" autofocus>

                                @error('birthdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- /BIRTHDATE FIELD --}}

                        {{-- EMAIL FIELD --}}
                        <div class="form-group row mb-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address *') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <div id="email-validation" class="text-danger"></div>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- /EMAIL FIELD --}}

                        {{-- PASSWORD FIELD --}}
                        <div class="form-group row mb-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <div id="password-length" class="text-danger"></div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- /PASSWORD FIELD --}}

                        {{-- CONFIRM PASSWORD FIELD --}}
                        <div class="form-group row mb-2">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <div id="message" class="text-danger"></div>
                            </div>
                        </div>
                        {{-- /CONFIRM PASSWORD FIELD --}}

                        {{-- SUBMIT BUTTON --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="submit-button" type="submit" class="main-btn">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        {{-- /SUBMIT BUTTON --}}
                    </form>
                </div>
                {{-- /REGISTRATION FORM --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script src="{{ asset('js/registerFormValidation.js') }}" defer></script>
@endpush