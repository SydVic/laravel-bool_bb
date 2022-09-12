<?php

use App\ExtraService;
use Illuminate\Database\Seeder;

class ExtraServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            'wi-fi',
            'posto macchina',
            'piscina',
            'colazione',
            'portineria',
            'sauna',
            'vista mare',
            'cucina',
            'lavatrice',
            'tv',
            'ascensore',
            'camino',
            'vettovaglie',
            'lavastoviglie',
            'aria consizionata',
        ];

        foreach($services as $service) {
            $extra_service = new ExtraService();
            $extra_service->name = $service;

            $extra_service->save();
        }
    }
}
