<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->realText(50),
                'content' => $faker->randomHtml(2, 3),
                'status' => rand(0, 1),
                'pulished_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
