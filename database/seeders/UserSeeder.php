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
      'email' => 'admin@example.com',
      'password' => 'password',
    ]);
    User::factory()->create([
      'email' => 'user1@example.com',
      'password' => 'password',
    ]);
    User::factory()->create([
      'email' => 'user2@example.com',
      'password' => 'password',
    ]);
    User::factory()->create([
      'email' => 'user3@example.com',
      'password' => 'password',
    ]);
    User::factory()->create([
      'email' => 'user4@example.com',
      'password' => 'password',
    ]);
  }
}
