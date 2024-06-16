<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class NcellNTCNumberCheck implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Define the regular expression pattern for Ncell and NTC contact numbers
        $pattern = '/^(980\d{7}|981\d{7}|982\d{7}|984\d{7}|985\d{7}|986\d{7}|974\d{7})$/';

        // Check if the contact number matches the pattern
        return preg_match($pattern, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid Ncell or NTC contact number.';
    }
}
