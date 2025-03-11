<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 100; $i++) {
            Product::create([
                'name' => $faker->word,
                'category_id' => rand(1, 15),
                'price' => $faker->randomFloat(2, 10, 500),
                'description' => $faker->sentence,
                'status' => $faker->randomElement(['active', 'inactive']),
            ]);
        }
    }
}
