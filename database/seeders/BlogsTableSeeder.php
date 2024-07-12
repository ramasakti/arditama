<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = DB::table('users')->pluck('id')->toArray(); // Mengambil semua ID pengguna

        for ($i = 0; $i < 50; $i++) {
            DB::table('blogs')->insert([
                'title' => $faker->sentence,
                'slug' => $faker->slug,
                'banner' => $faker->imageUrl(800, 400, 'business', true, 'Faker'),
                'description' => $faker->sentence,
                'content' => $faker->text,
                'created_by' => $faker->randomElement($users), // Pilih ID pengguna secara acak
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
