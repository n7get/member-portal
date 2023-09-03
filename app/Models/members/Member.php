<?php

namespace App\Models\members;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'first_name',
        'last_name',
        'mailing_address_street',
        'mailing_address_city',
        'mailing_address_state',
        'mailing_address_zip',
        'part_year_nv_resident',
        'callsign',
        'expiration',
        'gmrs_callsign',
        'cellPhone',
        'cell_sms_carrier',
        'winlink_account',
    ];

    protected $casts = [
        'part_year_nv_resident' => 'boolean',
        'winlink_account' => 'boolean',
        'expiration' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // x_id is the foreign key in table y
    }

    public function capabilities()
    {
        return $this->belongsToMany(Capability::class)->withPivot(['base', 'portable']);
    }

    public function certifications()
    {
        return $this->belongsToMany(Certification::class);
    }

    public function others() {
        return $this->belongsToMany(Other::class)->withPivot('extra_info');
    }

    public $timestamps = true; // If you want the created_at and updated_at timestamps to be handled automatically
}