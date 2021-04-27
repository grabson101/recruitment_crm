<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'website' => $faker->domainName,
        'email' => $faker->email,
        'logo' => UploadedFile::fake()->image(uniqid() . '.jpg')->store('company/logos', 'public'),
    ];
});
