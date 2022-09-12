<?php

use App\SponsorType;
use Illuminate\Database\Seeder;

class SponsorTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsor_types = [
            [
                'price' => 2.99,
                'name' => 'base',
                'duration_h' => 24
            ],
            [
                'price' => 5.99,
                'name' => 'medium',
                'duration_h' => 72
            ],
            [
                'price' => 9.99,
                'name' => 'premium',
                'duration_h' => 144
            ]
        ];

        foreach ($sponsor_types as $sponsor_type) {
            $new_sponsor_type = new SponsorType();
            $new_sponsor_type->fill($sponsor_type);
            $new_sponsor_type->save();
        }
    }
}
