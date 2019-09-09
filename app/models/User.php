<?php


namespace app\models;


use vendor\core\base\Model;

class User extends Model
{
    protected static $table = "users";

    public static function isUser($login, $password) {
        $user = self::exec("select * from logins where login=? and password=?", [$login, $password]);
        return $user;
    }

}