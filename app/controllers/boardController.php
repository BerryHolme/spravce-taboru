<?php

namespace controllers;

class boardController
{
    public function getBoard(\Base $base)
    {
        echo \Template::instance()->render("board.php");
    }

}