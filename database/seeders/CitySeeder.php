<?php

namespace Database\Seeders;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require 'all-cities.php';
        // var_dump($cities_array[0]);die;
        $min = City::count();
        $totals = count($cities_array); // 113530
        // dd($totals);
        for($i=0; $i<$totals; $i++) {

            if ($i + 1 > $min) {
                $city = $cities_array[$i];
                City::create($city);
            }
        }
    }
}
