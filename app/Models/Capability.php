<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capability extends Model
{
    protected $table = 'capabilities';
    
    protected $fillable = [
        'description',
        'order',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }

    public $timestamps = false; // Indicates that the table doesn't have created_at and updated_at timestamps
}
