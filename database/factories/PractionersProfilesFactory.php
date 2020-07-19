<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\PractionersProfiles;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(PractionersProfiles::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'profile_photo' => '/images/profile-photos/'.strtolower($faker->word).'-'.time().'.jpg',
        'phone_number' => $faker->randomNumber(6),
        'email' => $faker->email,
        'category_id' => $faker->numberBetween($min = 1, $max = 5),
        'location_id' => $faker->numberBetween($min = 1, $max = 5),
        'gallery_id' => $faker->numberBetween($min = 1, $max = 20),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});

