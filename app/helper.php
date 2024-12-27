<?php

use Illuminate\Support\Str;

if (!function_exists('generateRandomId')) {
    function generateRandomId()
    {
        return 'guest_' . Str::random(10);
    }
}
