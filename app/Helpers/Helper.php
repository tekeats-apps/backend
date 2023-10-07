<?php

use Illuminate\Support\Str;

if (!function_exists('truncate')) {
    function truncate(string $string, int $limit = 20, string $end = '...'): string
    {
        return Str::limit($string, $limit, $end);
    }
}
