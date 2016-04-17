<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

/**
 * Class BookTagTableSeeder
 */
class BookTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $tags = \App\Tag::lists('id')->toArray();
        $books = \App\Book::lists('id')->toArray();

        foreach (range(1, 30) as $index) {
            DB::table('book_tag')->insert([
                'book_id' => $faker->randomElement($books),
                'tag_id' => $faker->randomElement($tags),
            ]);
        }
    }
}