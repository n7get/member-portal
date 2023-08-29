<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testData = array(
            ['K7AAA', User::where('email', 'user2@example.com')->first()->id, 'active'],
            ['N7AAA', User::where('email', 'user3@example.com')->first()->id, 'pending'],
            ['W7AAA', User::where('email', 'user4@example.com')->first()->id, 'inactive'],
        );

        $users = User::all();

        foreach($testData as $data) {
            Member::factory()->create([
                'callsign' => $data[0],
                'user_id' => $data[1],
                'status' => $data[2],
            ]);
        }
    }
}
