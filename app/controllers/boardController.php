<?php

namespace controllers;

class boardController
{
    public function getBoard(\Base $base)
    {
        if($base->get("SESSION.user")){
            $camps = (new \models\camps)->find([], ['order' => 'id DESC']);
            $base->set('camps', $camps);

            $id = $base->get('SESSION.user[id]');
            $kids = (new \models\kids)->find(['parent_id', $id],['order' => 'birth DESC']);
            $base->set('kids', $kids);

            echo \Template::instance()->render("board.php");
        }else $base->reroute("/login");
    }

}