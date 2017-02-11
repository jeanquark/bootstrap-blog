<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();

        // Populate Posts Table
        $count_users = App\User::count();
        $count_posts = 10;
        $faker = Faker::create();

        for ($i = 0; $i < $count_posts; $i++) {
            $title[$i] = $faker->catchPhrase;
            $slug[$i] = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $title[$i]));
            DB::table('posts')->insert([
                'user_id' => $faker->numberBetween($min = 1, $max = $count_users),
                'title' => $title[$i],
                'slug' => $slug[$i],
                'content_html' => '<p>' . $faker->paragraph($nbSentences = 3, $variableNbSentences = true) . '</p></p>' . $faker->paragraph($nbSentences = 10, $variableNbSentences = true) . '</p>',
                'content_raw' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'excerpt' => '',
                'image_path' => 'pictures/image' . $i . '.jpg',
                'is_published' => $faker->numberBetween($min = 0, $max = 1),
                'published_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Populate Tags Table
        $slug = ['sint', 'voluptatem', 'quaerat', 'atque', 'expedita'];
        $name = ['Sint', 'Voluptatem', 'Quaerat', 'Atque', 'Expedita'];
        $count_tags = count($slug);

        for ($i = 0; $i < $count_tags; $i++) {
            DB::table('tags')->insert([
                'slug' => $slug[$i],
                'name' => $name[$i],
                'color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Populate Post_Tags Table
        for ($i = 1; $i <= $count_posts; $i++) {

            $nb_tags = rand(1, 5);
            $tags = range(1, $nb_tags);
            shuffle($tags);

            foreach ($tags as $tag) {
                DB::table('post_tags')->insert([
                    'post_id' => $i,
                    'tag_id' => $tag,
                ]);
            }
        }

        factory(App\Comment::class, 20)->create();
        factory(App\CommentReply::class, 10)->create();
        factory(App\Contact::class)->create();
    }
}