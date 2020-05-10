<?php

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        for ($i=0; $i < 30; $i++) {
            Product::create([
                'title' => $faker->sentence(4),
                'slug' => $faker->slug,
                'subtitle' => $faker->sentence(5),
                'description' =>$faker->text,
                'price' => $faker->numberBetween(10,300) * 100,
                'image' => $faker->imageUrl(200, 250, 'technics')
            ])->categories()->attach([
                rand(1, 4),
                rand(1, 4)
            ]);
        }
    }
}
