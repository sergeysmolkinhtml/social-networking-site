<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BlogCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [];

        $cName = 'No category';

        $categories[] = [

            'title' => $cName,
            'slug' => Str::slug($cName),
            'parent_id' => 0

        ];

        for ($i = 2; $i <= 11; $i++) {
            $cName = "Category #" . $i;
            $parentId = ($i > 4) ? rand(1, 4) : 1;


            $categories[] = [
                'title' => $cName,
                'slug' => Str::slug($cName),
                'parent_id' => $parentId,
            ];
        }

        DB::table('blog_categories')->insert($categories);

    }
}
