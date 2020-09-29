<?php
declare(strict_types=1);

use labo86\battle_royale\app\DataAccessMySql;

require_once(__DIR__ . '/../vendor/autoload.php');

$dao = new DataAccessMySql();
$pdo = $dao->getPDO();

$user_id = uniqid();
$password = password_hash('admin', PASSWORD_DEFAULT);
\labo86\rdtas\app\User::createUser($pdo, uniqid(),'admin', $password);