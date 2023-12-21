<?php
namespace controllers;
class IndexController
{
    public function index(\Base $base){
        echo \Template::instance()->render("index.php");

    }
}

