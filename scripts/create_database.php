<?php
declare(strict_types=1);

use tpl_company_tpl\tpl_project_tpl\app\DataAccessMySql;

require_once(__DIR__ . '/../vendor/autoload.php');

$dao = new DataAccessMySql();
$dao->createDatabase();
