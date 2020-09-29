<?php
declare(strict_types=1);

use tpl_company_tpl\tpl_project_tpl\app\DataAccessMySql;

function get_error_by_error_id(string $session_id, string $error_id) : array {
    $dao = new DataAccessMySql();
    $pdo = $dao->getPDO();

    $user = \labo86\rdtas\app\User::validateAdminFromSessionId($pdo, $session_id);

    foreach (labo86\rdtas\Util::readFileByLine(__DIR__ . '/../../var/error_log') as $line ) {
        $error = json_decode($line, true);
        if ( $error['i'] === $error_id )
            return $error;
    }
    return [];
}

function get_error_list(string $session_id) : array {
    $dao = new DataAccessMySql();
    $pdo = $dao->getPDO();

    $user = \labo86\rdtas\app\User::validateAdminFromSessionId($pdo, $session_id);

    $error_list = [];
    foreach (labo86\rdtas\Util::readFileByLine(__DIR__ . '/../../var/error_log') as $line ) {
        $error_list[] = json_decode($line, true);
    }
    return $error_list;
}

function get_php_server_info(string $session_id) : array {
    $dao = new DataAccessMySql();
    $pdo = $dao->getPDO();

    $user = \labo86\rdtas\app\User::validateAdminFromSessionId($pdo, $session_id);

    return [
        'post_max_size' => ini_get ( 'post_max_size'),
        'upload_max_filesize' => ini_get ( 'upload_max_filesize'),
        'max_file_uploads' => ini_get('max_file_uploads'),
        'ini_file' => php_ini_loaded_file()
    ];

}

function create_user(string $session_id, string $username, string $password) : array {
    $dao = new DataAccessMySql();
    $pdo = $dao->getPDO();

    $user = \labo86\rdtas\app\User::validateAdminFromSessionId($pdo, $session_id);

    $user_id = uniqid();
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    return \labo86\rdtas\app\User::createUser($pdo, $user_id, $username, $password_hash);
}

function set_user_type(string $session_id, string $username, string $type) : array {
    $dao = new DataAccessMySql();
    $pdo = $dao->getPDO();

    $user = \labo86\rdtas\app\User::validateAdminFromSessionId($pdo, $session_id);

    $user = \labo86\rdtas\app\User::getUserByName($pdo, $username);
    \labo86\rdtas\app\User::setUserType($pdo, $user['user_id'], $type);
    return [];
}

function set_user_password(string $session_id, string $username, string $password) : array {
    $dao = new DataAccessMySql();
    $pdo = $dao->getPDO();

    $user = \labo86\rdtas\app\User::validateAdminFromSessionId($pdo, $session_id);

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $user = \labo86\rdtas\app\User::getUserByName($pdo, $username);
    \labo86\rdtas\app\User::setUserPassword($pdo, $user['user_id'], $password_hash);

    return [];
}

function create_session(string $username, string $password) : array {
    $dao = new DataAccessMySql();
    $pdo = $dao->getPDO();

    return \labo86\rdtas\app\User::createSession($pdo, $username, $password);

}

function close_session(string $session_id) : array {
    $dao = new DataAccessMySql();
    $pdo = $dao->getPDO();

    \labo86\rdtas\app\User::closeSession($pdo, $session_id);
    return [];
}