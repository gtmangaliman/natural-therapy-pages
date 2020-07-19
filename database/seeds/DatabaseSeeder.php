<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	UsersSeeder::class,
        	PractionersProfilesSeeder::class,
        	PhotosSeeder::class,
        	LocationsSeeder::class,
        	GallerySeeder::class,
        	CategoriesSeeder::class
        ]);
    }
}
