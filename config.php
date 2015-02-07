<?php

return array(

    'database' => array(
        'user' => 'oomc',
        'pass' => 'cmoo',
        'host' => 'localhost',
        'name' => 'oomc',
    ),
    
    'routes' => array(
        '' => 'index/index',
        'story' => 'story/index',
        'story/create' => 'story/create',
        'comment/create' => 'comment/create',
        'user/create' => 'user/create',
        'user/account' => 'user/account',
        'user/login' => 'user/login',
        'user/logout' => 'user/logout',
    ),
);
