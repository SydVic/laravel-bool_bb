<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <?php
        // use App\Apartment;
        // use App\ApartmentSponsorType;
        // use App\SponsorType;
        // use Faker\Generator as Faker;

        // $apartments = Apartment::all();
        // $sponsor_types = SponsorType::all();


        // $apartment_sponsor = new ApartmentSponsorType();

        // $apartment = $apartments[0];
        // $sponsor_type = $sponsor_types[rand(0, $sponsor_types->count() - 1)];

        // $apartment_sponsor->apartment_id = $apartment->id;
        // $apartment_sponsor->sponsor_type_id = $sponsor_type->id;

        
        // // generiamo una data unix
        // $date_start_unix = strtotime('1980-10-23 16:35:23'); //1980-10-24 16:35:23
        // $date_start = date('Y-m-d H:i:s', $date_start_unix);
        // $date_end_unix = strtotime($date_start) + ($sponsor_type->duration_h * 60 * 60);
        // $date_end = date('Y-m-d H:i:s', $date_end_unix);

        // $apartment_sponsor->sponsor_start = $date_start;
        // $apartment_sponsor->sponsor_end = $date_end;

        // $relative = ApartmentSponsorType::where('id', $apartment_sponsor->apartment_id)
        //     // ->whereBetween('sponsor_end', [$date_start, $date_end])
        //     ->whereDate('sponsor_end', '>=', $date_start)
        //     ->whereDate('sponsor_end', '<=', $date_end)
        //     ->first();
        // dd($relative, $apartment_sponsor);
        // // $relative = ApartmentSponsorType::where('id', $apartment_sponsor->apartment_id)->where('sponsor_end', '>', $date_start)->first();
        // // $relative = ApartmentSponsorType::where('id', $apartment_sponsor->apartment_id)->where('sponsor_end', '>', date('Y-m-d H:i:s'))->first();
        // if($relative){
        //     dd('trovato un risultato', $relative);
        //     $date_start_unix = strtotime($relative->sponsor_end) + 1;
        //     $date_start = date('Y-m-d H:i:s', $date_start_unix);
        //     $date_end_unix = strtotime($date_start) + ($sponsor_type->duration_h * 60 * 60);
        //     $date_end = date('Y-m-d H:i:s', $date_end_unix);

        //     $apartment_sponsor->sponsor_start = $date_start;
        //     $apartment_sponsor->sponsor_end = $date_end;
        // }else{
        //     dd('non trovato', $sponsor_type->duration_h);
        // }


        // $apartment_sponsor->save();
        ?>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/user') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
