<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.07.19
 * Time: 12:59
 */

namespace app\controllers\App;

use vendor\core\base\Controller;

class MainController extends Controller
{
    public function index() {

        $this->getView()->render(["App/body_view", "header_view"], "main_layout");
    }
}