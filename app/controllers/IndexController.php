<?php
namespace controllers;
class IndexController
{
    public function index(\Base $base){
        echo \Template::instance()->render("index.php");

    }

    public function install(\Base $base)
    {
        \models\applications::setdown();
        \models\camps::setdown();
        \models\kids::setdown();
        \models\Users::setdown();

        \models\applications::setup();
        \models\camps::setup();
        \models\kids::setup();
        \models\Users::setup();
    }
}

