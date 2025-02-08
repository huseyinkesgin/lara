<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['code' => 'IL-01','name' => 'KOCAELİ'],
            ['code' => 'IL-02','name' => 'ISTANBUL']

        ];

        foreach ($cities as $city) {
            \App\Models\City::create($city);
        }
    }
}
