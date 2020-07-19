<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Locations;


class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Locations::class, 5)->create();
    }
}
