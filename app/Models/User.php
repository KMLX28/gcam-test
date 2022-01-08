<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $guarded = ['id'];
    protected $appends = ['trusted', 'type'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function trusted() : Attribute
    {
        return Attribute::get(fn() => $this->hasVerifiedEmail() || $this->is_approved);
    }

    public function type() : Attribute
    {
        return Attribute::get(fn() => 'user');
    }

    public function approvedBy()
    {
        return $this->belongsTo(HREmployee::class, 'approved_by');
    }

    public function card()
    {
        return $this->hasOne(EmployeeCard::class)->latestOfMany();
    }

    public function activeCard()
    {
        return $this->card()->where('expire_at', '>', now());
    }

    public function cardRequests()
    {
        return $this->hasMany(CardRequest::class);
    }

    public function lastCardRequest()
    {
        return $this->hasOne(CardRequest::class)->latestOfMany();
    }

    public function canRequestCard()
    {
        return $this->lastCardRequest()->where('status', CardRequest::$PENDING)->doesntExist() &&
            $this->activeCard()->doesntExist();
    }

    public function isCardExpired()
    {
        return !$this->card ? true : $this->card->isExpired();
    }
}
