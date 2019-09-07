<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.07.19
 * Time: 12:59
 */

namespace app\controllers;

use vendor\core\base\Controller;
use app\models\User;

class MainController extends Controller
{
    public function index() {
        $this->getView()->render(["App/body_view", "header_view"], "default_layout");

        $userData = [
            'login' => 'user',
            'email' => 'user@mail.ru',
            'password' => 'user'
        ];

        $user = new User();

        debug($user::findByFieldName('login', 'root1'));
    }
}