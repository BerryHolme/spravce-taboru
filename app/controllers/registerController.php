<?php

namespace controllers;

class registerController
{
    public function getRegister(\Base $base, $error_msg)
    {
        if(!is_null($error_msg)){
            $base->set('error_msg', '');
        }
        echo \Template::instance()->render("register.php");
    }

    public function postRegister(\Base $base)
    {
        $user = $base->get("SESSION.user[id]");
        if ($user) {
            $base->clear("SESSION.user");
        }
        $user = new \models\users();

        // Check if the email already exists
        $existingUser = $user->findone(["email=?", $base->get('POST.email')]);

        if ($existingUser) {
            // Email already exists
            $base->set('error_msg', 'Email už existuje');
            echo \Template::instance()->render("register.php");
            return;
        }
        // Save user data to the database
        $user->copyfrom($base->get('POST'));

        $user->save();

        $base->reroute("/login");


    }

}