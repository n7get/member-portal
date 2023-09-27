<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActiivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activityTypes = array(
            'Weekly Net',
            'Monthly Training',
            'Non-ARES Event',
            'ARES Event',
        );

        foreach ($activityTypes as $key => $description) {
            DB::table('activity_types')->insert([
                'description' => $description,
                'order' => $key,
            ]);
        }

        $activityModes = array(
            'ARDOP Winlink',
            'DMR',
            'DSTAR',
            'EchoLink',
            'HF',
            'Packet BBS',
            'Packet Winlink',
            'Pactor Winlink',
            'Repeaters',
            'VARA FM Winlink',
            'VARA HF Winlink',
            'Winlink',
        );

        foreach ($activityModes as $key => $description) {
            DB::table('activity_modes')->insert([
                'description' => $description,
                'order' => $key,
            ]);
        }

        $member2 = DB::table('members')->where('callsign', 'K7AAA')->first();
        $weeklyNet = DB::table('activity_types')->where('description', 'Weekly Net')->first();
        $monthTraining = DB::table('activity_types')->where('description', 'Monthly Training')->first();
        $varaFmWinlink = DB::table('activity_modes')->where('description', 'VARA FM Winlink')->first();
        $repeaters = DB::table('activity_modes')->where('description', 'Repeaters')->first();

        $activityId1 = DB::table('activities')->insertGetId([
            'description' => 'March 06, 2023 Weekly Net',
            'date' => '2023-09-27 19:00:00',
            'duration' => '30',
            'location' => 'On the air',
            'activity_type_id' => $weeklyNet->id,
        ]);
        DB::table('activity_logs')->insert([
            'activity_id' => $activityId1,
            'member_id' => $member2->id,
            'activity_mode_id' => $repeaters->id,
            'attended' => false,
        ]);

        $date = new \DateTime();
        $date->modify('+4 weeks');
        $activityId2 = DB::table('activities')->insertGetId([
            'description' => 'March 2023 Monthly Training',
            'date' => $date->format('Y-m-d') . ' 9:00:00',
            'duration' => '120',
            'location' => 'Fire Station 18',
            'activity_type_id' => $monthTraining->id,
        ]);
        DB::table('activity_logs')->insert([
            'activity_id' => $activityId2,
            'member_id' => $member2->id,
            'attended' => false,
        ]);
    }
}
