<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Locations;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Locations::class, function (Faker $faker) {
    return [
        'name' =>  ucfirst($faker->unique()->city),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});

