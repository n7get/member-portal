<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\Other;

class MemberOtherSeeder extends Seeder
{
  public function run()
  {
    $members = Member::all();
    $others = Other::all();

    foreach ($members as $member) {
      $selectOthers = $others->random(rand(1, $others->count()));
      foreach($selectOthers as $o) {
        if($o->needs_extra_info) {
          $member->others()->attach($o->id, [
            'extra_info' => 'fake',
          ]);
        } else {
          $member->others()->attach($o->id);
        }
      }
    }
  }
}
