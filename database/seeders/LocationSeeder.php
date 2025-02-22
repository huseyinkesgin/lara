<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Beos\City;
use App\Models\Beos\Town;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use Faker\Factory as Faker;

class LocationSeeder extends Seeder
{
    protected $cities = [];
    protected $towns = [];
    protected $districts = [];
    protected $neighborhoods = [];

    public function run()
    {
        $path = public_path('location/dosya.xlsx');

        // Excel verilerini al
        $rows = Excel::toArray([], $path)[0];

        // Başlık satırını kaldır
        array_shift($rows);

        DB::transaction(function () use ($rows) {
            foreach ($rows as $row) {
                $cityName = trim($row[0]); // İl
                $townName = trim($row[1]); // İlçe
                $districtName = trim($row[2]); // Semt
                $neighborhoodName = trim($row[3]); // Mahalle
                $postalCode = trim($row[4]); // Posta Kodu
                $codeCity = "IL" . trim($row[5]); // Kod
                $codeTown = "ILC" . fake()->numberBetween(1, 10000); // Kod
                $codeDistrict = "SEM" . fake()->numberBetween(1, 10000); // Kod
                $codeNeighborhood = "MAH" . fake()->numberBetween(1, 10000); // Kod

                // Şehir
                if (!isset($this->cities[$cityName])) {
                    $city = City::firstOrCreate(
                        ['name' => $cityName],
                        ['code' => $codeCity]
                    );
                    $this->cities[$cityName] = $city->id;
                    $this->command->info("Şehir eklendi: {$cityName}");
                }

                // İlçe
                $townKey = $cityName . '-' . $townName;
                if (!isset($this->towns[$townKey])) {
                    $town = Town::firstOrCreate(
                        [
                            'code' => $codeTown,
                            'city_id' => $this->cities[$cityName],
                            'name' => $townName,
                            'is_active' => true
                        ],
                    );
                    $this->towns[$townKey] = $town->id;
                    $this->command->info("İlçe eklendi: {$townName}");
                }

                // Semt
                $districtKey = $townKey . '-' . $districtName;
                if (!isset($this->districts[$districtKey])) {
                    $district = District::firstOrCreate(
                        [
                            'code' => $codeDistrict,
                            'town_id' => $this->towns[$townKey],
                            'name' => $districtName,
                            'is_active' => true
                        ],
                    );
                    $this->districts[$districtKey] = $district->id;
                    $this->command->info("Semt eklendi: {$districtName}");
                }

                // Mahalle
                Neighborhood::firstOrCreate(
                    [
                        'code' => $codeNeighborhood,
                        'district_id' => $this->districts[$districtKey],
                        'name' => $neighborhoodName,
                        'is_active' => true
                    ],
                    [
                        'postal_code' => $postalCode,
                    ]
                );
            }
        });

        $this->command->info('Tüm lokasyon verileri başarıyla eklendi!');
    }
}
