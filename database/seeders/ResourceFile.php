<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceFile extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('resources_files')->insert([
            'user_id' => 1,
            'name' => 'Test File',
            'file_name' => 'test-file.txt',
            'description' => 'This is a test file.',
            'version' => '1.0.0',
            'mime_type' => 'text/plain',
            'access' => 'public',
            'data' => 'This is a test file.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('resources_files')->insert([
            'user_id' => 1,
            'name' => 'Test File 2',
            'file_name' => 'test-file-2.txt',
            'description' => 'This is test file 2.',
            'version' => '1.0.0',
            'mime_type' => 'text/plain',
            'access' => 'leadership',
            'data' => 'This is a test file.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('resources_files')->insert([
            'user_id' => 1,
            'name' => 'Test File 3',
            'file_name' => 'test-file-2.html',
            'description' => 'This is test file 3.',
            'version' => '1.0.0',
            'mime_type' => 'text/html',
            'access' => 'member',
            'data' => '<html><head><title>Hello, World!</title></head><body><h1>Hello, World!</h1></body></html>',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
