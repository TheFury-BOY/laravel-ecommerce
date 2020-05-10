<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Category::create([
            'name' => 'High Tech',
            'slug' => 'high-tech',
        ]);

        Category::create([
            'name' => 'Fournitures de Bureau',
            'slug' => 'fournitures-bureaux',
        ]);

        Category::create([
            'name' => 'Enfants',
            'slug' => 'enfants',
        ]);

        Category::create([
            'name' => 'Jardin',
            'slug' => 'jardin',
        ]);

        Category::create([
            'name' => 'Livres',
            'slug' => 'livres',
        ]);
    }
}
