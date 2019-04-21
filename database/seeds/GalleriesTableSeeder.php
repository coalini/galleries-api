<?php

use Illuminate\Database\Seeder;

class GalleriesTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Gallery::class, 100)->create();
    }
}
