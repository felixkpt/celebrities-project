<?php

namespace Database\Seeders;

use App\Models\Enneagram;
use Faker\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnneagramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Factory::create();

        $enneagrams = [
            [
                'name' => 'Type Two', 'slug' => 'type-two', 'strength' => 'The Giver',
                'type' => 'The Heart Types of the Enneagram',
                'description' => 'Twos seek out opportunities to be helpful to others and to be accepted in order to feel like they belong. This kind is afraid of being unlovable.', 'content' => '', 'prevalence' => $this->faker->numberBetween(5, 15)
            ],
            [
                'name' => 'Type Three', 'slug' => 'type-three', 'strength' => 'The Achiever',
                'type' => 'The Heart Types of the Enneagram',
                'description' => 'Threes are very mindful of their public image and strive to be successful and well-liked by others. Failure and not being valued by others are fears for Type Threes.', 'content' => '', 'prevalence' => $this->faker->numberBetween(5, 15)
            ],
            [
                'name' => 'Type Four', 'slug' => 'type-four', 'strength' => 'The Individualist',
                'type' => 'The Heart Types of the Enneagram',
                'description' => 'Fours seek individuality and intense, genuine feelings. Type Fours are extremely concerned with how they are different from other people and fear that they are faulty.', 'content' => '', 'prevalence' => $this->faker->numberBetween(5, 15)
            ],
            [
                'name' => 'Type Five', 'slug' => 'type-five', 'strength' => 'The Investigator',
                'type' => 'The Head Types of the Enneagram',
                'description' => 'Fives are more at ease with facts than other people and strive for comprehension and information. Being overtaken by their own or other people\'s needs is the Type Five\'s greatest phobia.', 'content' => '', 'prevalence' => $this->faker->numberBetween(5, 15)
            ],
            [
                'name' => 'Type Six', 'slug' => 'type-six', 'strength' => 'The Skeptic',
                'type' => 'The Head Types of the Enneagram',
                'description' => 'Sixes are concerned with security, want safety, and enjoy being proactive in solving issues. Being unprepared and unable to defend yourself from harm is the Type Six\'s greatest worry.', 'content' => '', 'prevalence' => $this->faker->numberBetween(5, 15)
            ],
            [
                'name' => 'Type Seven', 'slug' => 'type-seven', 'strength' => 'The Enthusiast',
                'type' => 'The Head Types of the Enneagram',
                'description' => 'Seven-year-olds are easily bored and seek out as much excitement and adventure as they can. Type Sevens actively try to avoid emotional suffering by being busy because they fear feeling it, especially grief.', 'content' => '', 'prevalence' => $this->faker->numberBetween(5, 15)
            ],
            [
                'name' => 'Type Eight', 'slug' => 'type-eight', 'strength' => 'The Challenger',
                'type' => 'The Body Types of the Enneagram',
                'description' => 'Eights strive to defend their beliefs and view themselves as powerful and strong. The Type Eight is most afraid of being helpless, thus they concentrate on controlling their surroundings.', 'content' => '', 'prevalence' => $this->faker->numberBetween(5, 15)
            ],
            [
                'name' => 'Type Nine', 'slug' => 'type-nine', 'strength' => 'The Peacemaker',
                'type' => 'The Body Types of the Enneagram',
                'description' => 'Nines prefer to follow the crowd and let others set the agenda. People of Type Nine tend to be meek and fear alienating others by putting their own needs first.', 'content' => '', 'prevalence' => $this->faker->numberBetween(5, 15)
            ],
            [
                'name' => 'Type One', 'slug' => 'type-one', 'strength' => 'The Perfectionist',
                'type' => 'The Body Types of the Enneagram',
                'description' => 'Ones place a lot of value on doing things right and obeying the rules. Because they are afraid of being flawed, Type Ones can be very harsh with both themselves and other people.', 'content' => '', 'prevalence' => $this->faker->numberBetween(5, 15)
            ],
        ];

        foreach ($enneagrams as $enneagram) {
            $enneagram['image'] = 'images/enneagrams/' . $enneagram['slug'] . '.jpg';
            Enneagram::create($enneagram);
        }
    }
}
