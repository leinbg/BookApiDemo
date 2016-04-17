<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

/**
 * Class BooksTableSeeder
 */
class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        factory(\App\Book::class, 20)->create();
    }
}
