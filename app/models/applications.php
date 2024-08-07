<?php

namespace models;
use controllers\IndexController;
use DB\Cortex;

class applications extends Cortex
{
    protected $db='DB', $table ='applications';
    protected $fieldConf=[
        'id' =>['type'=>'INT4', 'nullable'=>false],
        'parent_id' =>['type'=>'INT4', 'nullable'=>false],
        'kid_id' =>['type'=>'INT4', 'nullable'=>false],
        'camp_id' =>['type'=>'INT4', 'nullable'=>false],
        'state' =>['type'=>'INT4', 'nullable'=>false],
        'time' =>['type'=>'DATETIME', 'nullable'=>false],
        'camp' =>['type'=>'VARCHAR256', 'nullable'=>false],
        'kid' =>['type'=>'VARCHAR256', 'nullable'=>false],

    ];
}