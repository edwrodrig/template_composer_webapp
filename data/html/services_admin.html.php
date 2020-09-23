<?php
declare(strict_types=1);

use labo86\rdtas\staty\BlockPageEasyServices;
use labo86\staty_core\PagePhp;

/** @var PagePhp $page **/
$page->prepareMetadata([
    'title' => 'Servicios de administrador',
    'description' => 'Manejo interno!'
]);

$BLOCK = new BlockPageEasyServices($page);
$BLOCK->setService('/controller/ws.php?method=get_services_admin');
$BLOCK->html();
