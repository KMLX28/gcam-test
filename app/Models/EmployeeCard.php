<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeCard extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'expire_at' => 'date'
    ];

    public function isExpired()
    {
        return $this->expire_at->isPast();
    }
}
