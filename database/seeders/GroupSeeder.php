<?php

namespace Database\Seeders;


use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends seeder
{
    public function run()
    {
        Group::factory()->count(50)->create();
    }

}
