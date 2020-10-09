<?php
declare(strict_types=1);

use labo86\rdtas\Util;

require_once(__DIR__ . '/../../vendor/autoload.php');

$default_data = [
    'error' => [
        'dir' => __DIR__ . '/../../var/log'
    ],
    'db' => [
        'type' => 'sqlite',
        'name' => __DIR__ . '/../../var/db.sqlite',
        'schema' => __DIR__ . '/../../ddl_tables.sql'
        /*
        'type' => 'mysql',
        'db' => 'tpl_company_tpl_tpl_project_tpl',
        'user' => 'tpl_company_tpl_tpl_project_tpl_app_user',
        'password' => 'password'
        */
    ]
];

$filename = __DIR__ . '/../../var/config.json';
Util::createDirectory(__DIR__ . '/../../var');
Util::arrayToFile($filename, $default_data);

printf("Modifica el archivo de configuración y despues corre el siguiente script\n");
