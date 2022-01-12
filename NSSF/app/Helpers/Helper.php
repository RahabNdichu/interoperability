<?php

namespace App\Helpers;

class Helper
{
    public static function MemberGenerator($model, $trow, $length, $prefix) {
        $data = $model::orderBy('id', 'desc')->first();
        if (!$data) {
            $og_length = $length;
            $last_number = '';
        } else {
            $code = substr($data->$trow, strlen($prefix));
            $actual_last_number = ($code);
            $increment_last_number = $actual_last_number;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }

        $zeros = "";
        for ($i=0; $i < $og_length; $i++) {
            $zeros.= "0";
        }

        return $prefix.$zeros.$last_number;
    }
}
