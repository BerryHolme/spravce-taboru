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

    public function postregisterKidToCamp(\Base $base)
    {
        $application = new \models\applications();
        $kidId = $base->get('POST.kidId');
        $campId = $base->get('POST.campId');

        $kids = new \models\kids();
        $kid = $kids->findone(["id=?",$kidId]);
        $name = $kid->name . ' ' . $kid->surname;

        $camps = new \models\camps();
        $camp = $camps->findone(["id=?",$campId]);
        $campName = $camp->name;


        // Check if the application already exists
        $existingApp = $application->findone(['kid_id = ? AND camp_id = ?', $kidId, $campId]);
        if ($existingApp) {
            echo 'Dítě je již přihlášeno na tento kemp.';
            return;
        }

        // Proceed with creating a new application
        $application->parent_id = $base->get('SESSION.user.id');
        $application->kid_id = $kidId;
        $application->camp_id = $campId;
        $application->state = 0;
        $application->time = (new DateTime())->format('Y-m-d H:i:s');
        $application->camp = $campName;
        $application->kid = $name;
        $application->save();

        echo 'Přihlášení proběhlo úspěšně';
    }

    public function getAppListParent(\Base $base)
    {
        if($base->get("SESSION.user")){
            $id = $base->get('SESSION.user[id]');
            $apps = (new \models\applications())->find(['parent_id', $id],['order' => 'time DESC']);
            $base->set('apps', $apps);
            echo \Template::instance()->render("applicationListParent.php");
        }else $base->reroute("/login");

    }

    public function postDeleteApp(\Base $base)
    {
        $id = $_POST['id'];
        $apps = new \models\applications();
        $app = $apps->findone(["id=?",$id]);
        $app ->erase();
    }

}