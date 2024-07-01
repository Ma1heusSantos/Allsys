<?php

use Carbon\Carbon;

if (!function_exists('money')) {
    function money($number)
    {
        return number_format($number, 2, ",", ".");
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }
}

if (!function_exists('getData')) {
    function getData()
    {
        return now('America/Sao_Paulo');
    }
}

if (!function_exists('hora')) {
    function hora($string)
    {
        return date('H:i', strtotime($string)) . "h";
    }
}

if (!function_exists('removeSpecialChars')) {
    function removeSpecialChars($string)
    {
        return preg_replace("/\D+/", "", $string);
    }
}