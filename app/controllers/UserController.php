<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.09.19
 * Time: 12:34
 */

namespace app\controllers;

use app\services\ApiService;
use app\services\ParseService;
use vendor\core\base\Controller;

class UserController extends Controller
{
    public function getPage()
    {
        $this->getView()->render(['header_view']);
    }

    public function addUsers()
    {
        $users = ParseService::fromCsvInArray(STORAGE . "/" . $_FILES['file']['name']);
        $data = ApiService::fork($users);
        $this->getView()->render(['header_view'],"default_layout", $data);
    }
}