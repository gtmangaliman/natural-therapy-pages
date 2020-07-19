<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Gallery;


class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Gallery::class, 20)->create();
    }
}
