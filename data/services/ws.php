<?php
declare(strict_types=1);

use tpl_company_tpl\tpl_project_tpl\app\Controller;

include_once(__DIR__ . '/../../vendor/autoload.php');

Controller::getConfigDefault();

$controller = new Controller();

$controller->run();