<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomersModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->call([
            CustomersTableSeeder::class,
            PurchaseTableSeeder::class
        ]);
    }
}
