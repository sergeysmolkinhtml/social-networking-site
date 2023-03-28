<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogPost;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*User::factory(20)->create();
        BlogPost::factory(20)->create();*/
        $this->call([
           /* BlogCategoriesSeeder::class,*/
            GroupSeeder::class,
        ]);

    }
}
