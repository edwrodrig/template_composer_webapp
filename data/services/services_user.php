<?php
declare(strict_types=1);

use tpl_company_tpl\tpl_project_tpl\app\Controller;
use tpl_company_tpl\tpl_project_tpl\app\DataAccessDb;

function say_hello(string $session_id, string $name) : string {
    $dao = new DataAccessDb(Controller::getConfigDefault());
    $pdo = $dao->getPDO();
    labo86\rdtas\app\User::validateSession($pdo, $session_id);
    return "hello " . $name;
}

function get_fruit_list(string $session_id) : array {
    $dao = new DataAccessDb(Controller::getConfigDefault());
    $pdo = $dao->getPDO();
    labo86\rdtas\app\User::validateSession($pdo, $session_id);

    return  [
      ['name' => 'manzana', 'color' => 'rojo', 'link' => 'https://es.wikipedia.org/wiki/Manzana'],
      ['name' => 'naranja', 'color' => 'naranjo', 'link' => 'https://es.wikipedia.org/wiki/Naranja'],
      ['name' => 'platano', 'color' => 'amarillo', 'link' => 'https://es.wikipedia.org/wiki/Platano']
    ];
}