<?php

use App\Apartment;
use App\ApartmentExtraService;
use App\ExtraService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApartmentExtraServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('apartment_extra_service')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        $apartments = Apartment::all();

        $extra_services = ExtraService::all();
        $combinations = $apartments->count() * $extra_services->count();
        $total = rand($combinations / 2 , $combinations);
        $count = 0;

        while($count < $total){
            $apartment_extra_service = new ApartmentExtraService();

            $apartment = $apartments[rand(0, $apartments->count() - 1)];
            $extra_service = $extra_services[rand(0, $extra_services->count() - 1)];

            $apartment_extra_service->apartment_id = $apartment->id;
            $apartment_extra_service->extra_service_id = $extra_service->id;

            $relative = ApartmentExtraService::where('apartment_id', $apartment_extra_service->apartment_id)->where('extra_service_id', $apartment_extra_service->extra_service_id)->first();

            if(!$relative){
                $count++;
                $apartment_extra_service->save();
            }
        }
    }
}
