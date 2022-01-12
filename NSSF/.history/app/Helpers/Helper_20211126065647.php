<?php

namespace App\Helpers;

class Helper
{
    public static function MemberGenerator($model, $trow, $length = 4, $prefix) {
        $data = $model::orderBy('id', 'desc')->first();
        if (!$data) {
            $og_length = $length;
            $last_number = '';
        } else {
            $code = substr($data->$trow, strlen())
        }
    }
}
