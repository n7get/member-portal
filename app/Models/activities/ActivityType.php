<?php

namespace App\Models\activities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'order',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
