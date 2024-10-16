<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UsersTg extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'username',
        'hash',
        'tdata',
        'score',
        'balance',
        'energy',
        'multitap',
        'energyLimit',
        'rechargingSpeed',
        'referrals',
        'inviter_id',
        'lastTapTime',
        'totalReferralsRewards',
        'joining_date',
        'currency_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'joining_date' => 'datetime',
            'hash' => 'hashed',
            'tdata' => 'hashed',
        ];
    }
}
