<?php

namespace Database\Seeders;

use App\Models\Capability;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        'data' => true,
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
        'data' => true,
        'prompt' => 'Served Agency?',
      ],
      [
        'description' => 'NTS traffic-handling Experience',
      ],
      [
        'description' => 'Other training',
        'data' => true,
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
        'data' => true,
      ],
      [
        'description' => 'Other Skills/Restrictions/Preferences',
        'data' => true,
      ],
      [
        'description' => 'PC Operating System',
        'data' => true,
      ],
    );

    foreach ($others as $key => $other) {
      DB::table('others')->insert([
        'description' => $other['description'],
        'data' => array_key_exists('data', $other) ? $other['data'] : false,
        'prompt' => array_key_exists('prompt', $other) ? $other['prompt'] : null,
        'order' => ($key + 1) * 10,
      ]);
    }
  }
}
