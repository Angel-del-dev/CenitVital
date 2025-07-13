<?php

namespace App\Http\Helpers;

class Calculus {
    public static function GrowPercentageIndex(int|float $last_month, int|float $current_month):int|float|null
    {
        if($last_month === 0) return null;
        return (($current_month - $last_month)/$last_month)*100;
    }
}