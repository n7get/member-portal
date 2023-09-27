<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use DateTime;

class DateHourMinuteCast implements CastsAttributes
{
  public function get($model, $key, $value, $attributes)
  {
    if (is_null($value)) {
      return null;
    }

    if (is_string($value)) {
      $value = new DateTime($value);
      return $value->format('m-d-y H:i');
    }

    throw new \InvalidArgumentException('The attribute must be a string?');
  }

  public function set($model, $key, $value, $attributes)
  {
    if (is_string($value)) {
      $date = DateTime::createFromFormat('m-d-y H:i', $value);
      return $date->format('Y-m-d H:i:s');
    }

    throw new \InvalidArgumentException('The attribute must be a string?');
  }
}
