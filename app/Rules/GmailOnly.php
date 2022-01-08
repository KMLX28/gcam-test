<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GmailOnly implements Rule
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
        return preg_match('/^[\w.+\-]+@gmail\.com$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'البريد الإلكتروني غير صحيح';
    }
}
