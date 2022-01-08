<?php

namespace App\Models;

use App\Jobs\CreateEmployeeCardJob;
use App\Traits\Acceptable;
use Illuminate\Database\Eloquent\Model;

class CardRequest extends Model
{
    use Acceptable;

    protected $guarded = ['id'];
    protected $appends = ['photo_url'];


    public function getPhotoUrlAttribute()
    {
        return isset($this->attributes['photo']) ? "/storage/{$this->attributes['photo']}" : '';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedByHREmployee()
    {
        return $this->belongsTo(HREmployee::class, 'approved_by_HREmployee');
    }

    public function approvedByHRManager()
    {
        return $this->belongsTo(HRManager::class, 'approved_by_HRManager');
    }

    public function isCompletelyApproved()
    {
        return $this->approved_by_HREmployee && $this->approved_by_HRManager;
    }

    public function processIfCompletelyApproved()
    {
        if ($this->isCompletelyApproved()) {
            $this->accept()->save();
            CreateEmployeeCardJob::dispatch($this)->delay(now()->addHour());
        }
    }
}
