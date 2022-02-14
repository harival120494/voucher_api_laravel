<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseModel;

class PurchaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurchaseModel::factory()->count(300)->create();
    }
}
