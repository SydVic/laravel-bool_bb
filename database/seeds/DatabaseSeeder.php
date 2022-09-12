<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ApartmentsSeeder::class);
        $this->call(MessagesSeeder::class);
        $this->call(ViewsSeeder::class);
        $this->call(ExtraServicesSeeder::class);
        $this->call(ApartmentExtraServiceSeeder::class);
        $this->call(SponsorTypesSeeder::class);
        $this->call(ApartmentSponsorTypesSeeder::class);
    }
}
