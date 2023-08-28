<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
      'password' => 'password',
    ]);
    User::factory()->create([
      'name' => 'Test User 2',
      'email' => 'test2@example.com',
      'password' => 'password',
    ]);
    User::factory()->create([
      'name' => 'Test User 3',
      'email' => 'test3@example.com',
      'password' => 'password',
    ]);
    User::factory()->create([
      'name' => 'Test User 4',
      'email' => 'test4@example.com',
      'password' => 'password',
    ]);
  }
}
