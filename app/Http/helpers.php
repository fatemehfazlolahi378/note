<?php

use Illuminate\Support\Facades\View;


if (!function_exists('digit_to_english')) {
    /**
     * @param $value
     * @return string
     */
    function digit_to_english($value)
    {
        return strtr($value, array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));
    }
}

if (!function_exists('digit_to_persian')) {
    /**
     * @param $value
     * @return string
     */
    function digit_to_persian($value)
    {
        return strtr($value, array('0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹'));
    }
}


