<?php

namespace Database\Seeders;

use App\Models\members\Capability;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OtherSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $others = array(
      [
        'description' => 'Operate CW',
        'needs_extra_info' => true,
        'prompt' => 'How many WPM?',
      ],
      [
        'description' => 'First Aid Certified',
      ],
      [
        'description' => 'CPR Certified',
      ],
      [
        'description' => 'Employee/contractor of Served Agency',
        'needs_extra_info' => true,
        'prompt' => 'Served Agency?',
      ],
      [
        'description' => 'NTS traffic-handling Experience',
      ],
      [
        'description' => 'Other training',
        'needs_extra_info' => true,
      ],
      [
        'description' => 'RV Motorhome/RV Trailer/Boat/Aircraft',
      ],
      [
        'description' => 'High Clearance Vehicle W/ 4WD',
      ],
      [
        'description' => 'Utility Trailer',
      ],
      [
        'description' => 'Off-grid Power: Battry & Solar/Wind/Generator',
      ],
      [
        'description' => 'Other Equipment',
        'needs_extra_info' => true,
      ],
      [
        'description' => 'Other Skills/Restrictions/Preferences',
        'needs_extra_info' => true,
      ],
      [
        'description' => 'PC Operating System',
        'needs_extra_info' => true,
      ],
    );

    foreach ($others as $key => $other) {
      DB::table('member_others')->insert([
        'description' => $other['description'],
        'needs_extra_info' => array_key_exists('needs_extra_info', $other) ? $other['needs_extra_info'] : false,
        'prompt' => array_key_exists('prompt', $other) ? $other['prompt'] : null,
        'order' => ($key + 1) * 10,
      ]);
    }
  }
}
