<?php

namespace Database\Factories;

use App\Models\CustomersModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomersModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomersModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => 'Male',
            'date_of_birth' => $this->faker->date(),
            'contact_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail
        ];
    }
}
