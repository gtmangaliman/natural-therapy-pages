<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Gallery;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Http\Helpers\StatusHelper as STATUS;

$factory->define(Gallery::class, function (Faker $faker) {
    return [
        'title' =>  ucfirst($faker->unique->text),
        'status' => STATUS::ACTIVE,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});

