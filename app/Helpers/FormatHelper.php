<?php

namespace App\Helpers;

use Carbon\Carbon;

class FormatHelper
{
    static function formatDecimal($value)
    {
        switch(config('app.locale'))
        {
            case "en":
                return number_format($value, 2, '.', ',');
            case "de":
                return number_format($value, 2, ',', '.');
            default:
                return number_format($value, 2, '.', ',');
        }
    }

    static function formatToDatabaseDecimal($value)
    {
        if ($value == null)
        {
            return $value;
        }
        
        switch(config('app.locale'))
        {
            case "de":
                return str_replace(',', '.', $value);
            default:
                return $value;
        }
    }

    static function formatToDatabaseDate($value)
    {
        if($value == null ||$value == "")
        {
            return $value;
        }
        // TODO Handle invalid format
        return Carbon::parse($value)->format('Y-m-d');
    }

    static function formatToDate($value)
    {
        if($value == null)
        {
            return "";
        }
        
        switch(config('app.locale'))
        {
            case "en":
                return Carbon::parse($value)->format('m/d/Y');
            case "de":
                return Carbon::parse($value)->format('d.m.Y');
            default:
                return Carbon::parse($value)->format('m/d/Y');
        }
    }
}