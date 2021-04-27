<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    $company = Company::inRandomOrder()->first();
    if($company === null)
        $company = factory(Company::class)->create();
    return [
        'first_name' => $faker->name(),
        'last_name' => $faker->lastName(),
        'email' => $faker->email(),
        'phone' => $faker->phoneNumber(),
        'company_id' => $company->id,
    ];
});
