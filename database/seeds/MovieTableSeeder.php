<?php

use App\Movie;
use Illuminate\Database\Seeder;

class MovieTableSeeder extends Seeder
{
    public function run()
    {
        factory(Movie::class, 500)->create();
    }
}
