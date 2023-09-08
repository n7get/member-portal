<?php

namespace App\Models\members;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $table = 'member_certifications';

    protected $fillable = [
        'description',
        'order',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'members_member_certifications');
    }

    public $timestamps = false; // Indicates that the table doesn't have created_at and updated_at timestamps
}
