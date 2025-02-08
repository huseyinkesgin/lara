<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            ['city_id' => 1, 'code' => 'IL-01-01', 'name' => 'ÇAYIROVA'],
            ['city_id' => 1, 'code' => 'IL-01-02', 'name' => 'DARICA'],
            ['city_id' => 1, 'code' => 'IL-01-03', 'name' => 'DİLOVASI'],
            ['city_id' => 1, 'code' => 'IL-01-04', 'name' => 'GEBZE'],
            ['city_id' => 1, 'code' => 'IL-01-05', 'name' => 'GÖLCÜK'],
            ['city_id' => 1, 'code' => 'IL-01-06', 'name' => 'KANDIRA'],
            ['city_id' => 1, 'code' => 'IL-01-07', 'name' => 'KARAMÜRSEL'],
            ['city_id' => 1, 'code' => 'IL-01-08', 'name' => 'KARTEPE'],
            ['city_id' => 1, 'code' => 'IL-01-09', 'name' => 'KÖRFEZ'],
            ['city_id' => 2, 'code' => 'IL-02-01', 'name' => 'ADALAR'],
            ['city_id' => 2, 'code' => 'IL-02-02', 'name' => 'ARNAVUTKÖY'],
            ['city_id' => 2, 'code' => 'IL-02-03', 'name' => 'ATAŞEHİR'],
            ['city_id' => 2, 'code' => 'IL-02-04', 'name' => 'AVCILAR'],
        ];

        foreach ($districts as $district) {
            \App\Models\District::create($district);
        }
    }
}
