<?php

namespace Database\Factories;

use App\Models\PurchaseModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchaseModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => mt_rand(1, 10),
            'total_spent' => mt_rand(10, 100),
            'total_saving' => mt_rand(10, 100),
            'transaction_at' => $this->faker->dateTimeThisMonth()
        ];
    }
}
