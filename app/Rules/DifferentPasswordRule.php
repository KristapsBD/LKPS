<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DifferentPasswordRule implements ValidationRule
{
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = DB::table('users')->where('email', $this->email)->first();

        if ($user && Hash::check($value, $user->password)) {
            $fail('The new password must be different from the old password.');
        }
    }
}
