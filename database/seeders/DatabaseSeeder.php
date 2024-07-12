<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BlogsTableSeeder;
use Database\Seeders\DataCategorySeeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')
            ->insert([
                'name' => 'Admin SMP Arditama',
                'email' => 'admin@smparditamawaru.sch.id',
                'password' => bcrypt('admin123'),
            ]);

        DB::table('master_category')
            ->insert([
                'name' => 'PPDB'
            ]);
        DB::table('master_category')
            ->insert([
                'name' => 'Pengumuman'
            ]);
        DB::table('master_category')
            ->insert([
                'name' => 'Sosial'
            ]);
        DB::table('master_category')
            ->insert([
                'name' => 'Prestasi'
            ]);

        $this->call([
            BlogsTableSeeder::class,
            DataCategorySeeder::class,
        ]);
    }
}
