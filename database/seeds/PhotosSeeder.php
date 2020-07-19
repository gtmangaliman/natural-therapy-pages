<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Photos;


class PhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Photos::class, 20)->create();
    }
}
