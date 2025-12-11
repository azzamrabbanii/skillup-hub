<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Web Development', 'Graphic Design', 'Data Science', 'Digital Marketing'];

        foreach ($categories as $cat) {
            DB::table('categories')->insert([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
