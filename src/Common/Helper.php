<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/31
 * Time: 11:18
 */

namespace PMysql\Common;

class Helper
{
    public static function bytesToString($bytes)
    {
        return implode(array_map('chr', $bytes));
    }

    public static function stringToBytes($data)
    {
        $bytes = [];
        $count = strlen($data);
        for ($i = 0; $i < $count; ++$i) {
            $byte = ord($data[$i]);
            $bytes[] = $byte;
        }

        return $bytes;
    }
}
