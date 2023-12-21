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
        $camps = (new \models\camps)->find([], ['order' => 'id DESC']);
        $base->set('camps', $camps);

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

    public function stopCamp(\Base $base)
    {
        $id = $_POST['id'];
        $camps = new \models\camps();
        $camp = $camps->findone(["id=?",$id]);
        $camp->state = 1;
        $camp->save();
    }

    public function startCamp(\Base $base)
    {
        $id = $_POST['id'];
        $camps = new \models\camps();
        $camp = $camps->findone(["id=?",$id]);
        $camp->state = 0;
        $camp->save();
    }

    public function kidsAdmin(\Base $base)
    {
        $id = $_POST['id'];
        $apps = (new \models\applications())->find(['camp_id=?', $id],['order' => 'time DESC']);

        $base->set('apps', $apps);

        $camps = new \models\camps();
        $camp = $camps->findone(["id=?",$id]);
        $base->set('camp', $camp->name);

        echo \Template::instance()->render("kidAdmin.php");


    }

    public function denieApp(\Base $base)
    {
        $id = $_POST['id'];
        $apps = new \models\applications();
        $app = $apps->findone(["id=?",$id]);
        $app->state = 2;
        $app->save();
    }

    public function acceptApp(\Base $base)
    {
        $id = $_POST['id'];
        $apps = new \models\applications();
        $app = $apps->findone(["id=?",$id]);
        $app->state = 1 ;
        $app->save();
    }

}