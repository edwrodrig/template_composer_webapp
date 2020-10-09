<?php
declare(strict_types=1);

use tpl_company_tpl\tpl_project_tpl\app\Controller;
use tpl_company_tpl\tpl_project_tpl\app\DataAccessDb;

require_once(__DIR__ . '/../../vendor/autoload.php');

$config = Controller::getConfigDefault();

$db = $config->getDatabase('db');

$database_name = $db['db'];
$database_user = $db['user'];
$database_password = $db['password'];

DataAccessDb::createCredentials($db->getName(), $db->getUser(), $db->getPassword());
