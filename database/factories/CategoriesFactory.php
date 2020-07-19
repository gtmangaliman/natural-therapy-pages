<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Categories;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Categories::class, function (Faker $faker) {
    return [
        'name' =>  ucfirst($faker->unique()->word),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});

