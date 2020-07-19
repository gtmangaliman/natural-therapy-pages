<?php

use Illuminate\Database\Seeder;
use App\Http\Models\PractionersProfiles;


class PractionersProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PractionersProfiles::class, 25)->create();
    }
}
