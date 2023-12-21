<?php

namespace controllers;

use DateTime;

class adminControl
{
    public function postLoginAdmin(\Base $base)
    {
        $name = $base->get("POST.name");
        $pass = $base->get("POST.pass");

        if($name=='admin'){
            if($pass=='admin'){
                $base->set("SESSION.admin.[state]", 1);
                $base->reroute("/admin");
            }
        }
        $error_msg = 'Špatné heslo nebo jméno';
        $base->set('error_msg', $error_msg);
        echo \Template::instance()->render("loginAdmin.php");

    }

    public function getLoginAdmin(\Base $base, $error_msg)
    {
        if(!is_null($error_msg)){
            $base->set('error_msg', '');
        }
        echo \Template::instance()->render("loginAdmin.php");
    }

    public function getAdmin(\Base $base)
    {
        if(!$base->get("SESSION.admin.state")){
            $base->reroute("/adminLogin");
        }

        echo \Template::instance()->render("admin.php");
    }

    public function adminLogout(\Base $base)
    {
        $admin = $base->get("SESSION.admin");
        if ($admin) {
            $base->clear("SESSION.admin");
            $base->reroute("/");
        }
    }

    public function postNewcamp(\Base $base)
    {
        $camp = new \models\camps();
        $camp->copyfrom($base->get('POST'));

        $camp->save();
        echo 'vytvořeno';
    }

}