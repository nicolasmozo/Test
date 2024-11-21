<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

function menuActive($routeName, $submenu = false)
{
    $class = $submenu ? 'submenu_active' : 'active';

    if (is_array($routeName)) {
        return in_array(request()->route()->getName(), $routeName) ? $class : '';
    }

    return request()->routeIs($routeName) ? $class : '';
}


function randomNumber($length = 7) {
    $random = '';
    $possible = '0123456789';

    for ($i = 0; $i < $length; $i++) {
        $random .= $possible[rand(0, strlen($possible) - 1)];
    }

    return $random;
}

function keyToTitle($text)
{
    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}

if (!function_exists('formatUploadLimit')) {
    function formatUploadLimit($limit) {
        return $limit === -1 ? 'Unlimited' : $limit;
    }
}
