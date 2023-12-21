<?php

namespace models;
use controllers\IndexController;
use DB\Cortex;

class applications extends Cortex
{
    protected $db='DB', $table ='applications';
    protected $fieldConf=[
        'id' =>['type'=>'INT', 'nullable'=>false],
        'parent_id' =>['type'=>'INT', 'nullable'=>false],
        'kid_id' =>['type'=>'INT', 'nullable'=>false],
        'camp_id' =>['type'=>'INT', 'nullable'=>false],
        'state' =>['type'=>'INT', 'nullable'=>false],
        'time' =>['type'=>'DATETIME', 'nullable'=>false],
        'camp' =>['type'=>'VARCHAR256', 'nullable'=>false],
        'kid' =>['type'=>'VARCHAR256', 'nullable'=>false],

    ];
}