<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomersModel;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomersModel::factory()->count(10)->create();
    }
}
