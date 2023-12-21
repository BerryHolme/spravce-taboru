<?php

namespace controllers;

use DateTime;

class kidsController
{
    public function postKid(\Base $base)
    {
        $today = new DateTime();
        $dob = new DateTime($_POST['birthdate']);
        $age = $today->diff($dob)->y;

        if ($age < 5) {
            echo 'Dítě musí být starší 5 let';
            return;
        }

        $kid = new \models\kids();
        $existingkid = $kid->findone(["name=?", $_POST['name']]);
        if ($existingkid) {
            echo 'Vaše dítě už existuje';
        } else {
            $kid->copyfrom($base->get('POST'));
            $formattedBirthDate = $dob->format('Y-m-d');
            $kid->birth = $formattedBirthDate;
            $kid->parent_id = $base->get('SESSION.user.id');
            $kid->save();
            echo 'Registrace byla úspěšná';
        }
    }


    public function parentKids(\Base $base)
    {
        if($base->get("SESSION.user")){
            $id = $base->get('SESSION.user[id]');
            $kids = (new \models\kids)->find(['parent_id', $id],['order' => 'birth DESC']);
            $base->set('kids', $kids);
            echo \Template::instance()->render("parentKids.php");
        }else $base->reroute("/login");
    }

    public function deleteKid(\Base $base)
    {
        $id = $_POST['id'];
        $kids = new \models\kids();
        $kid = $kids->findone(["id=?",$id]);
        $kid ->erase();
    }

}