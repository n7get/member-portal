<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use DateInterval;

class DurationCast implements CastsAttributes
{
  public function get($model, $key, $value, $attributes)
  {
    if (is_null($value)) {
      return null;
    }

    if ($value < 60) {
      return "${value}";
    }
    if ($value < (24 * 60)) {
      $hours = intdiv($value, 60);
      $minutes = $value % 60;

      return sprintf('%02d:%02d', $hours, $minutes);
    }

    $hours = intdiv($value, 60);
    $days = intdiv($hours, 24);
    $hours = $hours % 24;
    $minutes = $value % 60;
    return sprintf('%d:%02d:%02d', $days, $hours, $minutes);    
  }

  public function set($model, $key, $value, $attributes)
  {
    if (is_int($value)) {
      return $value;
    }

    if (is_string($value)) {
      $parts = explode(':', $value);

      match(count($parts)) {
        1 => $result = (int) $parts[0],
        2 => $result = (int) $parts[0] * 60 + (int) $parts[1],
        3 => $result = ((int) $parts[0] * 24 + (int) $parts[1]) * 60 + (int) $parts[2],
        default => throw new \InvalidArgumentException('The duration value must be an integer or a DateInterval object.'),
      };

      return $result;
    }

    if ($value instanceof DateInterval) {
      return ($value->h * 60) + $value->i;
    }

    throw new \InvalidArgumentException('The duration value must be an integer or a DateInterval object.');
  }
}
