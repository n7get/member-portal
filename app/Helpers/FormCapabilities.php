<?php

namespace App\Helpers;

use App\Models\members\Member;
use Illuminate\Http\Request;

/*
  This class exists because when a form fails validation
  $request->old() data has a different structure than the
  original $member->capabilities.  
*/

class FormCapabilities {
  private $capabilities;

  public function __construct(Request $request, Member $member) {
    $values = $request->old('capabilities', null);
    if ($values != null) {
      foreach($values as $key => $value) {
        $values[$key]['id'] = $key;
      }
      $this->capabilities = $values;
    } else {
      $this->capabilities = $member->capabilities->pluck('id')->map(function($id) use ($member) {
        return array(
          'id' => $id,
          'base' => $member->capabilities->find($id)?->pivot?->base,
          'portable' => $member->capabilities->find($id)?->pivot?->portable,
        );
      })->toArray();
    }
  }

  public function all() {
    return $this->capabilities;
  }
  
  public function has($id) {
    return $this->find($id) !== null;
  }

  public function base($id) {
    $capability = $this->find($id);
    if($capability === null) {
      return false;
    }
    return key_exists('base', $capability) ? $capability['base'] : false;
  }

  public function portable($id) {
    $capability = $this->find($id);
    if($capability === null) {
      return false;
    }
    return key_exists('portable', $capability) ? $capability['portable'] : false;
  }

  private function find($id) {
    foreach($this->capabilities as $capability) {
      if($id == $capability['id']) {
        return $capability;
      }
    }
    return null;
  }
}
