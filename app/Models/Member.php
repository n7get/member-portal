<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'email',
        'winlink_account',
    ];

    protected $casts = [
        'part_year_nv_resident' => 'boolean',
        'winlink_account' => 'boolean',
        'expiration' => 'date',
    ];

    public function capabilities()
    {
        return $this->belongsToMany(Capability::class)->withPivot(['base', 'portable']);
    }

    public function certifications()
    {
        return $this->belongsToMany(Certification::class);
    }

    public function others() {
        return $this->belongsToMany(Other::class)->withPivot('data');
    }

    public $timestamps = true; // If you want the created_at and updated_at timestamps to be handled automatically
}
