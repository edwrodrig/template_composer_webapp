<?php
declare(strict_types=1);

use labo86\rdtas\staty\BlockAutoServices;
use labo86\staty_core\PagePhp;
use tpl_company_tpl\tpl_project_tpl\site\BlockPage;

/** @var PagePhp $page **/
$page->prepareMetadata([
    'title' => '',
    'description' => 'Mi super asombrosa webapp'
]);

$BLOCK = new BlockPage($page);
$BLOCK->sectionBeginBodyContent();

$BLOCK_AUTO = new BlockAutoServices($page);
$BLOCK_AUTO->setService($BLOCK->service());
$BLOCK_AUTO->html();

$BLOCK->html();