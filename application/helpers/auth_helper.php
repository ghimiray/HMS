<?php

function check_login($required_group = 1, $current_department = 0)
{
    if (!UID or !USER_GROUP) redirect('login');
    if (USER_GROUP > $required_group) die(redirect_page());
    if (USER_GROUP > 1 and ((int) DEPARTMENT_ID !==(int) $current_department)) die(redirect_page());
}

function redirect_page($time = 1000)
{
    $user_group = defined('USER_GROUP') ? USER_GROUP : 0;
    $redirect_url = base_url(getURL());
    $html = <<<EOT
    Unauthorised Access !!! You are being redirected...
<script>setTimeout(function(){ window.location='$redirect_url' }, $time);</script>
EOT;
    return $html;
}

function getURL()
{
    $uid = UID;
    $gid = USER_GROUP;
    if (!$uid or !$gid) return '/';
    $did = DEPARTMENT_ID;
    $navs = [
        0 => 'dashboard',
        1 => 'company',
        2 => 'employee',
        3 => 'reservation',
        4 => 'rooms_and_types',
        5 => 'departments',
        6 => 'restaurants_and_menu',
        7 => 'sports_facility',
        8 => 'transport',
        9 => 'events',
        10 => 'parking',
    ];
    if ($gid == 1) {
        return $navs[0];
    } elseif ($gid == 2) {
        return $navs[$did];
    } elseif ($uid) {
        return 'my-account';
    } else {
        return '/';
    }
}