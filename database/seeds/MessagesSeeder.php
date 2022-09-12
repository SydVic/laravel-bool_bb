<?php


use App\Apartment;
use App\Message;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments = Apartment::all();

        for ($i=0; $i < 100; $i++) {
            $apartment = $apartments[rand(0, $apartments->count() - 1)];

            $message = new Message();
            $message->apartment_id = $apartment->id;
            $message->email = $faker->email();
            $message->user_name = $faker->firstName();
            $message->user_lastname = $faker->lastName();
            $message->text = $faker->paragraph();

            $message->save();
        }
    }
}
