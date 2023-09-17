<?php

namespace Database\Seeders;

use App\Models\resources\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('resources_categories')->insert([
            'name' => 'Member Category',
            'description' => 'This is a member category',
            'access' => 'member',
            'order' => 1,
        ]);
        DB::table('resources_categories')->insert([
            'name' => 'Leadership Category',
            'description' => 'This is an leadership category',
            'access' => 'leadership',
            'order' => 2,
        ]);
    }
}
