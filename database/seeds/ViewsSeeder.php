<?php

use App\Apartment;
use App\View;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViewsSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('views')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $apartments = Apartment::all();

        for ( $i=0; $i < 10000; $i++) {
            $apartment = $apartments[rand(0, $apartments->count() - 1)];
            
            $view = new View();
            $view->apartment_id = $apartment->id;
            $view->ip = $faker->ipv6();
            $timestamp = mt_rand(1, time());
            // generiamo una data unix
            $line_date_unix = strtotime('2015-01-01 12:00:00'); //non generare sponsorizzezioni precedenti a questa data
            $current_date_unix = time();
            $date_start_unix = rand($line_date_unix, $current_date_unix);
            $date_start = date('Y-m-d H:i:s', $date_start_unix);

            $view->date=$date_start;
            $view->save();
        }
    }
}
