<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostContent;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Throwable;

class PostSeeder extends Seeder
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

        $counts = 100;
        for($i=0; $i<$counts; $i++) {
           $content = '<p>'.implode('</p><p>', $this->faker->paragraphs($this->faker->numberBetween(5, 200))).'</p>';
           $post = [
            'title' => $title = Str::limit(ucfirst(implode(' ', $this->faker->words($this->faker->numberBetween(4, 20)))), 150),
            'slug' => Str::slug($title),
            'description' => Str::limit(strip_tags($content), $this->faker->numberBetween(50, 150)),
            'post_type' => 'post',
            'featured_image' => 'uploads/posts/images/default.png',
           ];
           if(!Post::where('title', $title)->first()) {
               
                try {
                    DB::beginTransaction();

                    $post = Post::create($post);
                
                    PostContent::create(['post_id' => $post->id, 'content' => $content]);
                    // Attaching authors (post_user table)
                    $users = User::inRandomOrder()->take(rand(1,3))->pluck('id');
                    
                    $manager_id = $users[rand(0, count($users) - 1)];
                    foreach ($users as $user) {
                        $post->authors()->attach($user, ['manager_id' => $manager_id]);
                    }
                    DB::commit();
                } catch (Throwable $e) {
                    DB::rollback();
                }
            
           }

        }

    }
}
