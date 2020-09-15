<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $faker->unique()->safeEmail,
            'phone' => $faker->tollFreePhoneNumber,
            'address' => $faker->streetAddress,
            'city' => $faker->city,
            'region' => $faker->state,
            'country' => 'US',
            'postal_code' => $faker->postcode,
        ];
    }
}
