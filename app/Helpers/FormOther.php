<?php

namespace App\Helpers;

use App\Models\members\Member;
use Illuminate\Http\Request;

/*
  This class exists because when a form fails validation
  $request->old() data has a different structure than the
  original $member->others.  
*/

class FormOther
{
  private array $others;

  public function __construct(Request $request, Member $member) {
    $values = $request->old('others', null);
    if ($values != null) {
      $this->others = array_filter($values, function ($value) {
        return array_key_exists('id', $value);
      });
    } else {
      $this->others = $member->others->pluck('id')->map(function($id) use ($member) {
        return array('id' => $id, 'extra_info' => $member->others->find($id)?->pivot?->extra_info);
      })->toArray();
    }
  }

  public function all() {
    return $this->others;
  }
  
  public function has($id) {
    return $this->find($id) !== null;
  }

  public function extra_info($id) {
    $other = $this->find($id);
    if($other === null) {
      return null;
    }
    return $other['extra_info'];
  }

  private function find($id) {
    foreach($this->others as $other) {
      if($id == $other['id']) {
        return $other;
      }
    }
    return null;
  }
}
