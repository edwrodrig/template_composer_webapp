<?php
declare(strict_types=1);

use labo86\rdtas\app\DataAccessFolder;
use tpl_company_tpl\tpl_project_tpl\app\Controller;
use tpl_company_tpl\tpl_project_tpl\app\DataAccessDb;

require_once(__DIR__ . '/../../vendor/autoload.php');

$config = Controller::getConfigDefault();
$dao = new DataAccessDb($config);
$dao->createTables();
if ( $dao->getConfig()->getType() === 'sqlite') {
    passthru(sprintf('chown -R www-data:www-data %s', $dao->getConfig()->getName()));
}

$error = new DataAccessFolder($config->getFolder('error'));
$error->createDirectory();

passthru(sprintf('chown -R www-data:www-data %s', $error->getDirectory()));
