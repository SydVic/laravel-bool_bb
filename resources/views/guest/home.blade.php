<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <title>Bool B&B</title>
</head>
<body>
  <div id="root">
    @if (Auth::check())
      <mainapp
      :logged-in= "true"
      user="{{ Auth::user() }}"
      user-route="{{ route('user.dashboard') }}"
      >
      </mainapp>
      @else
      <mainapp
      :logged-in= "false"
      login-route="{{ route('login') }}"
      register-route="{{ route('register') }}"
      >

      </mainapp>
    @endif
  </div>

  <script src="{{ asset('js/front.js') }}"></script>
</body>
</html>