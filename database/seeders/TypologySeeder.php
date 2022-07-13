<?php

namespace Database\Seeders;

use App\Models\Typology;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypologySeeder extends Seeder
{
    protected $faker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Factory::create();
       
        $personalities = [
        ['name' => 'ISTJ', 'slug' => 'istj', 'strength' => 'Inspector', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'ISTP', 'slug' => 'istp', 'strength' => 'Crafter', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'ISFJ', 'slug' => 'isfj', 'strength' => 'Protector', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'ISFP', 'slug' => 'isfp', 'strength' => 'Artist', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'INFJ', 'slug' => 'infj', 'strength' => 'Advocate', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'INFP', 'slug' => 'infp', 'strength' => 'Mediator', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'INTJ', 'slug' => 'intj', 'strength' => 'Architect', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'INTP', 'slug' => 'intp', 'strength' => 'Thinker', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)],
        ['name' => 'ESTP', 'slug' => 'estp', 'strength' => 'Persuader', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'ESTJ', 'slug' => 'estj', 'strength' => 'Director', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'ESFP', 'slug' => 'esfp', 'strength' => 'Performer', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'ESFJ', 'slug' => 'esfj', 'strength' => 'Caregiver', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'ENFP', 'slug' => 'enfp', 'strength' => 'Champion', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'ENFJ', 'slug' => 'enfj', 'strength' => 'Giver', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'ENTP', 'slug' => 'entp', 'strength' => 'Debater', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)], 
        ['name' => 'ENTJ', 'slug' => 'entj', 'strength' => 'Commander', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15)],];
        
        foreach ($personalities as $personality) {
            $personality['featured_image'] = 'images/typologies/'.strtolower($personality['name']).'.jpg';
            Typology::create($personality); 
        }


    }
}
