<?php

namespace controllers;

class controls
{
    public function logout(\Base $base)
    {
        $user = $base->get("SESSION.user[id]");
        if ($user) {
            $base->clear("SESSION.user");
        }
        $base->reroute('/');
    }


}