<?php

namespace models;

use controllers\IndexController;
use DB\Cortex;

class kids extends Cortex
{
    protected $db='DB', $table ='kids';
    protected $fieldConf=[
        'id' =>['type'=>'INT', 'nullable'=>false],
        'parent_id' =>['type'=>'INT', 'nullable'=>false],
        'name' =>['type'=>'VARCHAR256','nullable' =>false],
        'surname' =>['type'=>'VARCHAR256','nullable' =>false],
        'birth' => ['type'=>'DATE', 'nullable' =>false]
    ];
}