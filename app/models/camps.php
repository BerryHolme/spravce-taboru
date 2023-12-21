<?php

namespace models;

use controllers\IndexController;
use DB\Cortex;

class camps extends Cortex
{
    protected $db='DB', $table ='camps';
    protected $fieldConf=[
        'id' =>['type'=>'INT', 'nullable'=>false],
        'name' =>['type'=>'varchar256', 'nullable'=>false],
        'skupina'=>['type'=>'varchar256', 'nullable'=>false],
        'place-coordinates'=>['type'=>'varchar256', 'nullable'=>false],
        'placename'=>['type'=>'varchar256', 'nullable'=>false],
        'kids'=>['type'=>'INT', 'nullable'=>false],
        'leaders'=>['type'=>'INT', 'nullable'=>false],
        'start'=>['type'=>'DATE', 'nullable'=>false],
        'end'=>['type'=>'DATE', 'nullable'=>false],
        'info'=>['type'=>'varchar256', 'nullable'=>false],

    ];

}