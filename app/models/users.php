<?php

namespace models;

use controllers\IndexController;
use DB\Cortex;

class Users extends Cortex
{
    protected $db='DB', $table ='parents';
    protected $fieldConf=[
        'id' =>['type'=>'INT', 'nullable'=>false],
        'name' =>['type'=>'VARCHAR256','nullable' =>false],
        'surname' =>['type'=>'VARCHAR256','nullable' =>false],
        'email'=>['type'=>'VARCHAR256','nullable' =>false, 'index'=>true, 'unique'=>true, 'default'=>true],
        'password'=>['type'=>'VARCHAR256','nullable' =>false],
    ];
}