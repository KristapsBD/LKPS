<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Phone implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Only allow 8 digit phone numbers that start with +371
        if (!preg_match('/^\+371\d{8}$/', $value)) {
            $fail('The :attribute must be a valid Latvian phone number with the prefix +371.');
        }
    }
}
