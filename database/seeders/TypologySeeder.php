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
        DB::table('typologies')->truncate();
        
        $featured_image = 'uploads/images/typologies/default.png';

        $personalities = [
        ['name' => 'ISTJ', 'slug' => 'istj', 'strength' => 'Inspector', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'ISTP', 'slug' => 'istp', 'strength' => 'Crafter', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'ISFJ', 'slug' => 'isfj', 'strength' => 'Protector', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'ISFP', 'slug' => 'isfp', 'strength' => 'Artist', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'INFJ', 'slug' => 'infj', 'strength' => 'Advocate', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'INFP', 'slug' => 'infp', 'strength' => 'Mediator', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'INTJ', 'slug' => 'intj', 'strength' => 'Architect', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'INTP', 'slug' => 'intp', 'strength' => 'Thinker', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image],
        ['name' => 'ESTP', 'slug' => 'estp', 'strength' => 'Persuader', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'ESTJ', 'slug' => 'estj', 'strength' => 'Director', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'ESFP', 'slug' => 'esfp', 'strength' => 'Performer', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'ESFJ', 'slug' => 'esfj', 'strength' => 'Caregiver', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'ENFP', 'slug' => 'enfp', 'strength' => 'Champion', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'ENFJ', 'slug' => 'enfj', 'strength' => 'Giver', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'ENTP', 'slug' => 'entp', 'strength' => 'Debater', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image], 
        ['name' => 'ENTJ', 'slug' => 'entj', 'strength' => 'Commander', 'description' => $this->faker->paragraph, 'prevalence' => $this->faker->numberBetween(5, 15), 'featured_image' => $featured_image],];
        
        foreach ($personalities as $personality) {
            Typology::create($personality); 
        }


    }
}
