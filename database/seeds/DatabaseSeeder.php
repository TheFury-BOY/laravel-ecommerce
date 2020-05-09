<?php

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
        // A passer avant les produits
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
