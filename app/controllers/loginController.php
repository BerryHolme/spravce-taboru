<?php

namespace controllers;

class loginController
{
    public function getLogin(\Base $base, $error_msg)
    {
        $user = $base->get("SESSION.user[id]");
        if ($user) {
            $base->reroute("/board");
        }

        if(!is_null($error_msg)){
            $base->set('error_msg', '');
        }
        echo \Template::instance()->render("login.php");
    }

    public function postLogin(\Base $base)
    {
        $user = $base->get("SESSION.user[id]");
        if ($user) {
            $base->clear("SESSION.user");
        }

        $email = $base->get("POST.email");
        $user = new \models\users();
        $base->clear("SESSION.user");
        $u = $user->findone(["email=?", $email]);

        if ($u) {  // Check if user exists
            if ($base->get('POST.password') == $u->password) {
                $base->set("SESSION.user[id]", $u->id);
                $base->set("SESSION.user[name]", $u->name);
                $base->set("SESSION.user[surname]", $u->surname);
                $base->set("SESSION.user[email]", $u->email);

                $base->reroute("/board");
            } else {
                $base->set ('error_msg', 'Špatné heslo' );
                echo \Template::instance()->render("login.php");
            }
        } else {
            $base->set ('error_msg', 'Uživatel neexistuje' );
            echo \Template::instance()->render("login.php");
        }

    }

}