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
        $callsigns = array(
            'AA7A',
            'K7AAA',
            'N7AAA',
            'W7AAA',
        );

        $users = User::all();

        foreach($callsigns as $key => $callsign) {
            $user = $users[$key];
            echo 'user: ' . $user->id;

            Member::factory()->create([
                'user_id' => $user->id,
                'callsign' => $callsign,
            ]);
        }
    }
}
