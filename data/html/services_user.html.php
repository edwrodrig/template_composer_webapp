<?php
declare(strict_types=1);

use labo86\staty_core\PagePhp;
use labo86\rdtas\staty\BlockPageEasyServices;

/** @var PagePhp $page **/
$page->prepareMetadata([
    'title' => 'Servicios de usuario',
    'description' => 'Otros servicios para que pueda usar el usuario'
]);

$BLOCK = new BlockPageEasyServices($page);
$BLOCK->setService('/controller/ws.php?method=get_services_user');
$BLOCK->html();