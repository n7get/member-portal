<?php

namespace App\Models;

use App\Models\members\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function name(): string {
        if ($this->member) {
            return $this->member->first_name . ' ' . $this->member->last_name;  
        }
        if ($this->hasRole('admin')) {
            return '(admin)';
        }
        if ($this->hasRole('leadership')) {
            return '(leadership)';
        }
        if ($this->hasRole('member')) {
            return '(member)';
        }
        return $this->email;
    }

    function needsMember(): bool {
        if ($this->member) {
            return false;
        }
        if ($this->hasRole('admin') || $this->hasRole('leadership')) {
            return false;
        }
        return true;
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'user_id'); // x_id is the foreign key in table y
    }
}
