<?php

namespace app\services;
use app\models\User;
use ConstantManager;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;


/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.09.19
 * Time: 12:55
 */
class ApiService
{
    private static $jar;
    private static $textHtml;
    private static $ejsid;
    private static $sid;

    private static $dataForView = [];

    public static function fork($users)
    {
        self::authInEjudge();
        self::$sid = ParseService::searchSidInResponse(self::$textHtml);
        self::addUsersOnServer($users);
        return self::$dataForView;
    }

    private static function authInEjudge()
    {
        $param =[
            'form_params' => [
                'login' => EJUDGE_LOGIN,
                'password' => EJUDGE_PASSWORD,
                'SID' => "0000000000000000",
            ]
        ];

        self::$jar = new CookieJar();

        $client = new Client([
            'base_url' => 'http://localhost',
            'cookies' => self::$jar,
            'allow_redirects' => true,
            'decode_content' => true
        ]);

        self::$textHtml = htmlspecialchars(
            $client->request('post',
                BASE_URL, $param)
                ->getBody()
                ->getContents());


        self::$ejsid = self::$jar->getCookieByName("EJSID")->getValue();
    }

    private function addUsersOnServer($users)
    {
        $count  = $users['count'];
        unset($users['count']);

        if ($count === 3) {
            self::addUsersWithContestId($users);
        } else {
            self::addUsersWithoutContestId($users);
        }
    }


    private static function addUsersWithContestId($users)
    {
        foreach ($users as $user) {
            $param = [
                'form_params' => [
                    'other_login' => $user['login'],
                    'reg_password1' => $user['password'],
                    'reg_password2' => $user['password'],
                    'SID' => self::$sid,
                    'reg_cnts_create' => '1',
                    'other_contest_id_1' => $user['contest_id'],
                    'cnts_status' => '0',
                    'action_73' => ''
                ]
            ];
            $client = new Client([
                'base_url' => 'http://localhost',
                'cookies' => self::$jar,
                'allow_redirects' => true,
                'decode_content' => true
            ]);

            $res = $client->request('post', BASE_URL, $param);
            self::validResponseData(htmlspecialchars($res->getBody()->getContents()), $user);
        }
    }

    private static function addUsersWithoutContestId($users) {
        foreach ($users as $user) {
            $param = [
                'form_params' => [
                    'other_login' => $user['login'],
                    'reg_password1' => $user['password'],
                    'reg_password2' => $user['password'],
                    'SID' => self::$sid,
                    'reg_cnts_create' => '1',
                    'other_contest_id_1' => '0',
                    'cnts_status' => '0',
                    'action_73' => ''
                ]
            ];
            $client = new Client([
                'base_url' => 'http://localhost',
                'cookies' => self::$jar,
                'allow_redirects' => true,
                'decode_content' => true
            ]);

            $res = $client->request('post', BASE_URL, $param);
            self::validResponseData(htmlspecialchars($res->getBody()->getContents()), $user);
        }
    }

    private function validResponseData($text, $user) {

        if (stristr($text, ConstantManager::user_already_exist)){
            $status = "Пользователь уже существует";
        } elseif (stristr($text, ConstantManager::invalidContestId)){
            $status = "Неправильный идентификатор контеста";
        } elseif (stristr($text, ConstantManager::invalidValue)){
            $status = "Неверное значение";
        } elseif (User::isUser($user['login'], $user['password'])) {
            $status = "OK";
        } else {
            $status = "Пользователь не добавлен";
        }
        self::$dataForView[] = [
            "status" => $status,
            "login" => $user['login']
        ];
    }




}