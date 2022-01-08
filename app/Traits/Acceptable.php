<?php


namespace App\Traits;


trait Acceptable
{
    static $PENDING = 'pending';
    static $ACCEPTED = 'accepted';
    static $REJECTED = 'rejected';

    protected static function bootAcceptable()
    {
        static::creating(function($resource) {
            $resource->fill(['state' => $resource->state ?? self::$PENDING]);
        });
    }

    public function accept()
    {
        return tap($this)->fill(['status' => self::$ACCEPTED]);
    }

    public function reject()
    {
        return tap($this)->fill(['status' => self::$REJECTED]);
    }
}
