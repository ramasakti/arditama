<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = DB::table('blogs')->pluck('id')->toArray();
        $categories = DB::table('master_category')->pluck('id')->toArray();

        foreach ($blogs as $blog_id) {
            DB::table('data_category')->insert([
                'blog_id' => $blog_id,
                'category' => $categories[array_rand($categories)], // Pilih ID kategori secara acak
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
