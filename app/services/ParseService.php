<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.09.19
 * Time: 12:56
 */

namespace app\services;


class ParseService
{
    public static function searchSidInResponse($text)
    {
        $pos = stripos($text, "SID");

        $sid = substr($text, $pos, 20);

        $sid = explode("=", $sid);

        return $sid[1];
    }

    public static function fromCsvInArray($data)
    {

        $rows = array_map('str_getcsv', file($data));
        $headers = array_shift($rows);

        $users = [];

        if (count($headers) === 2) {
            $users['count'] = 2;
        } else {
            $users['count'] = 3;
        }

        foreach ($rows as $row) {
            $users[] = array_combine($headers, $row);
        }
        return $users;
    }
}