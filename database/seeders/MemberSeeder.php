<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        foreach($callsigns as $callsign) {
            Member::factory()->create([
                'callsign' => $callsign,
            ]);
        }
    }
}
