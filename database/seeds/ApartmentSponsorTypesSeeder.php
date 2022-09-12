<?php

use App\Apartment;
use App\ApartmentSponsorType;
use App\SponsorType;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class ApartmentSponsorTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('apartment_sponsor')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        
        $apartments = Apartment::all();
        $sponsor_types = SponsorType::all();

        $count = $apartments->count() * 2;
        for ($i=0; $i < $count; $i++) { 
            $apartment_sponsor = new ApartmentSponsorType();

            $apartment = $apartments[rand(0, $apartments->count() - 1)];
            $sponsor_type = $sponsor_types[rand(0, $sponsor_types->count() - 1)];

            //impostare le foreign keys
            $apartment_sponsor->apartment_id = $apartment->id;
            $apartment_sponsor->sponsor_type_id = $sponsor_type->id;

            
            // generiamo una data unix
            $line_date_unix = strtotime('2015-01-01 12:00:00'); //non generare sponsorizzezioni precedenti a questa data
            $current_date_unix = time();

            $date_start_unix = rand($line_date_unix, $current_date_unix);
            $date_start = date('Y-m-d H:i:s', $date_start_unix);
            $date_end_unix = strtotime($date_start) + ($sponsor_type->duration_h * 60 * 60);
            $date_end = date('Y-m-d H:i:s', $date_end_unix);

            //controllare se già esiste una sponsorizzazione
            $relative = ApartmentSponsorType::where('apartment_id', $apartment->id)
                ->where('sponsor_start', '<=', $date_start)
                ->where('sponsor_end', '>=', $date_start)
                ->first();

            while($relative){
                //c'è già una sponsorizzaione attiva, impostare la data di inizio alla data di fine di quella attiva + 1s
                $date_start_unix = strtotime($relative->sponsor_end) + 1;
                $date_start = date('Y-m-d H:i:s', $date_start_unix);
                $date_end_unix = strtotime($date_start) + ($sponsor_type->duration_h * 60 * 60);
                $date_end = date('Y-m-d H:i:s', $date_end_unix);
    
                $relative = ApartmentSponsorType::where('apartment_id', $apartment->id)
                    ->where('sponsor_start', '<=', $date_start)
                    ->where('sponsor_end', '>=', $date_start)
                    ->first();
            }

            $apartment_sponsor->sponsor_start = $date_start;
            $apartment_sponsor->sponsor_end = $date_end;

            $apartment_sponsor->save();

            // $timestamp = mt_rand(1, time());
            // $apartment_sponsor->sponsor_start = date('Y-m-d H:i:s', $timestamp);

            // $apartment_sponsor->sponsor_end = ((clone $apartment_sponsor)->sponsor_start)->add(new DateInterval("PT{$sponsor_type->duration_h}H"))->format('Y-m-d H:i:s');

            // $start_date = $apartment_sponsor->sponsor_start;
            // $modified = (clone $start_date)->add(new DateInterval("{$sponsor_type->duration_h}"));
            // $modified->format('Y-m-d H:i:s');
            // $apartment_sponsor->save();
        }
    }
}
