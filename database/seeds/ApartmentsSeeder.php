<?php

use App\Apartment;
use App\User;
use Illuminate\Database\Seeder;
use App\Http\Controllers\Api\ApartmentsAddressController;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class ApartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('apartments')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $users = User::all();

        for ( $i=0; $i < 50; $i++) {
            $rndImg = rand(1, 1000);
            $user = $users[rand(0, $users->count() - 1)];
            $apartment = new Apartment();
            $apartment->user_id = $user->id;
            $apartment->title = $faker->sentence();
            $apartment->slug = Apartment::generateUniqueSlug($apartment->title);
            $apartment->price = $faker->randomFloat(2, 100, 3000);
            $apartment->description = $faker->paragraph();
            $apartment->rooms_number = $faker->numberBetween(1, 15);
            $apartment->beds_number = $faker->numberBetween(1, 8);
            $apartment->bathrooms_number = $faker->numberBetween(1, 8);
            $apartment->mqs = $faker->numberBetween(40, 300);
            // $apartment->address = $faker->townState();
            $apartment->address = $faker->address();
            // dd($apartment->address);
            $coordinates = ApartmentsAddressController::index($apartment->address);
            $apartment->latitude = $coordinates['lat'];
            $apartment->longitude = $coordinates['lon'];
            // $apartment->latitude = $faker->latitude();
            // $apartment->longitude = $faker->longitude();
            $apartment->image = 'https://picsum.photos/id/'. $rndImg . '/200/300';
            $apartment->visibility = $faker->boolean();

            $apartment->save();
        }
    }
}
