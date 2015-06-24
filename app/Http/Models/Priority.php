<?php

namespace App\Http\Models;

class Priority
{
    public static function dict()
    {
        return [
            '0'=> '十万火急',
            '2'=> '一般',
            '1'=> '紧急',
            '3'=> '悠着点',
        ];
    }
}
