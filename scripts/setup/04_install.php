<?php
declare(strict_types=1);

use tpl_company_tpl\tpl_project_tpl\app\Controller;
use tpl_company_tpl\tpl_project_tpl\app\ControllerInstaller;

require_once(__DIR__ . '/../../vendor/autoload.php');

$installer = new ControllerInstaller(Controller::getConfigDefault());
$installer->prepareDataStores();
