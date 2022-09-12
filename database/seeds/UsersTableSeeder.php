<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $password = 'password';

        for ($i=0; $i < 100; $i++) {
            $user = new User();
            $user->name = $faker->firstName();
            $user->lastname = $faker->lastName();
            $user->birthdate = $faker->date();
            $user->email = $faker->unique()->email();
            $user->password = Hash::make($password);

            $user->save();
        }
    }
}
