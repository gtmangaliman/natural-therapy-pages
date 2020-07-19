<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Photos;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Http\Helpers\StatusHelper as STATUS;

$factory->define(Photos::class, function (Faker $faker) {
    return [
        'gallery_id' => $faker->numberBetween($min = 1, $max = 20),
        'path' => '/images/gallery/'.strtolower($faker->word).'-'.time().'.jpg',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});

