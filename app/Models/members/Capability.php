<?php

namespace App\Models\members;

use Illuminate\Database\Eloquent\Model;

class Capability extends Model
{
    protected $table = 'member_capabilities';
    
    protected $fillable = [
        'description',
        'order',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'members_member_capabilities');
    }

    public $timestamps = false; // Indicates that the table doesn't have created_at and updated_at timestamps
}
