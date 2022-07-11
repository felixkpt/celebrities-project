<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(1)->create();
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CountrySeeder::class);
        // $this->call(CitySeeder::class);
        $this->call(TypologySeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(PersonSeeder::class);
        // $this->call(PostSeeder::class);
    }
}
