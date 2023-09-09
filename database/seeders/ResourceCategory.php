<?php

namespace Database\Seeders;

use App\Models\resources\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('resources_categories')->insert([
            'name' => 'Public Category',
            'description' => 'This is a public category',
            'access' => 'public',
            'order' => 10,
        ]);
        DB::table('resources_categories')->insert([
            'name' => 'Member Category',
            'description' => 'This is a member category',
            'access' => 'member',
            'order' => 20,
        ]);
        DB::table('resources_categories')->insert([
            'name' => 'Leadership Category',
            'description' => 'This is an leadership category',
            'access' => 'leadership',
            'order' => 30,
        ]);
    }
}
