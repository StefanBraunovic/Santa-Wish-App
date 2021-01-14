<?php

$gradovi = [
    'pg' => 'Podgorica',
    'nk' => 'Niksic',
    'br' => 'Bar',
    'bd' => 'Budva'
];


function is_alpha_mne($string)
{
    $letters = str_split("abcdefghijklmnopqrstuvwxyzčćšđžśź");
    $string_arr = str_split(mb_strtolower($string));

    foreach ($string_arr as $char) {
        if (!in_array($char, $letters)) {
            return false;
        }
    }
    return true;
}


function validation()
{
    global $gradovi;
    $wish_arr = $_POST;
    $greske = [];
    $first_name = $wish_arr['first-name'];
    $last_name = $wish_arr['last-name'];
    $city = $gradovi[$wish_arr['city']];
    $wish = $wish_arr['wish-text'];

    if (empty($first_name)) {
        $greske[] = 0;
    }

    if (!is_alpha_mne($first_name)) {
        $greske[] = 1;
    }

    if (empty($last_name)) {
        $greske[] = 2;
    }

    if (!is_alpha_mne($last_name)) {
        $greske[] = 3;
    }

    if (!isset($wish_arr['was-good']) || $wish_arr['was-good'] !== 'on') {
        $greske[] = 4;
    }

    if (empty($city)) {
        $greske[] = 5;
    }

    if (empty($wish)) {
        $greske[] = 6;
    }

    return $greske;
}


function create_wish($arr)
{
    $res = [];
    global $cities;
    foreach ($arr as $field => $value) {
        switch ($field) {
            case 'first-name':
                $res['firstName'] = $value;
                break;
            case 'last-name':
                $res['lastName'] = $value;
                break;
            case 'city':
                $res['city'] = $cities[$value];
                break;
            case 'wish-text':
                $res['wish'] = $value;
                break;
        }
    }
    return $res;
}
