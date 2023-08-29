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
      'name' => 'Admin',
      'email' => 'admin@example.com',
      'password' => 'password',
    ]);
    User::factory()->create([
      'name' => 'User 1',
      'email' => 'user1@example.com',
      'password' => 'password',
    ]);
    User::factory()->create([
      'name' => 'User 2',
      'email' => 'user2@example.com',
      'password' => 'password',
    ]);
    User::factory()->create([
      'name' => 'User 3',
      'email' => 'user3@example.com',
      'password' => 'password',
    ]);
    User::factory()->create([
      'name' => 'User 4',
      'email' => 'user4@example.com',
      'password' => 'password',
    ]);
  }
}
