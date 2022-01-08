<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SaudiMobile implements Rule
{
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^^((([0]{2}|[+])966)|0)5\d{8}$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'صيغة رقم الجوال غير صحيحة';
    }
}
