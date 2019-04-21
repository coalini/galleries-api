<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(GalleriesTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
