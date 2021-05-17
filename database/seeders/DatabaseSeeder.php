<?php

namespace Database\Seeders;

use CometOneSolutions\Accounting\Database\Seeds\AccountingTablesSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create([
        //     'email' => 'admin@email.com'
        // ]);
        $this->call(AccountingTablesSeeder::class);
        \App\Models\Warehouse::factory(10)->create();
        \App\Models\Customer::factory(100)->create();
        \App\Models\Product::factory(100)->create();
    }
}
