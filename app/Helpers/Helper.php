<?php

use Illuminate\Support\Str;

if (!function_exists('truncate')) {
    function truncate(string $string, int $limit = 20, string $end = '...'): string
    {
        return Str::limit($string, $limit, $end);
    }
}


if (!function_exists('generate_otp_code')) {
    /**
     * Generate an N-digit OTP (One-Time Password) with random numbers.
     *
     * @param int $digits
     * @return string
     */
    function generate_otp_code($digits)
    {
        // Ensure the provided digit limit is within a reasonable range
        $digits = max(1, min($digits, 9));

        // Calculate the minimum and maximum values based on the digit limit
        $minValue = pow(10, $digits - 1);
        $maxValue = pow(10, $digits) - 1;

        // Generate a random number within the specified range
        $otp = rand($minValue, $maxValue);

        // Convert to string to ensure the correct number of digits
        return number_format($otp, 0, '', '');
    }
}
