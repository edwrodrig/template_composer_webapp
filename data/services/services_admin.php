<?php
declare(strict_types=1);

use labo86\exception_with_data\ExceptionForFrontEnd;
use labo86\rdtas\pdo\Util;
use tpl_company_tpl\tpl_project_tpl\app\DataAccessMySql;

function get_error_by_error_id(string $error_id) : array {
    foreach (labo86\rdtas\Util::readFileByLine(__DIR__ . '/../../var/error_log') as $line ) {
        $error = json_decode($line, true);
        if ( $error['i'] === $error_id )
            return $error;
    }
    return [];
}

function get_user_unfriendly_error_list() : array {
    $error_list = [];
    foreach (labo86\rdtas\Util::readFileByLine(__DIR__ . '/../../var/error_log') as $line ) {
        $error = json_decode($line, true);
        if ( $error['m'] === 'some error has occurred') {
            $error_list[] = $error;
        }
    }
    return $error_list;
}

function get_user_error_list() : array {
    $error_list = [];
    foreach (labo86\rdtas\Util::readFileByLine(__DIR__ . '/../../var/error_log') as $line ) {
        $error = json_decode($line, true);
    }
    return $error_list;
}

function get_php_server_info() : array {
    return [
        'post_max_size' => ini_get ( 'post_max_size'),
        'upload_max_filesize' => ini_get ( 'upload_max_filesize'),
        'max_file_uploads' => ini_get('max_file_uploads'),
        'ini_file' => php_ini_loaded_file()
    ];

}

function create_user(string $username, string $password) : array {
    $dao = new DataAccessMySql();
    $pdo = $dao->getPDO();

    $user_id = uniqid();
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    Util::updateOne($pdo,"INSERT INTO users (user_id, name, password_hash) VALUES (:user_id, :name, :password_hash)", [
        'user_id' => $user_id,
        'name' => $username,
        'password_hash' => $password_hash,
        'type' => 'REGISTERED'
    ]);

    return [
        'user_id' => $user_id,
        'name' => $username
    ];
}


function get_session(string $username, string $password) : array {
    $dao = new DataAccessMySql();
    $pdo = $dao->getPDO();

    $row = Util::selectRow($pdo,"SELECT user_id, name, password_hash FROM users WHERE name = :name AND type = :type", [
        'name' => $username,
        'type' => 'REGISTERED',
    ]);

    $session_id = md5(microtime());
    $password_hash = $row['password_hash'];
    if ( !password_verify($password, $password_hash) ) {
        throw new ExceptionForFrontEnd('error al ingresar', [], new ExceptionWithData('wrong password', [
            'username' => $username,
            'password' => $password
        ]));
    }

    $user_id = $row['user_id'];
    $date = new DateTime();
    $creation_date = $date->format("Y-m-d H:i:s");
    $date->add(new DateInterval('P1D'));
    $expiration_date =  $date->format("Y-m-d H:i:s");
    Util::updateOne($pdo, 'INSERT INTO sessions (session_id, user_id, creation_date, expiration_date, state) VALUES (:session_id, :user_id, :creation_date, :expiration_date, :state)',
        [
            'session_id' => $session_id,
            'user_id' => $user_id,
            'creation_date' => $creation_date,
            'expiration_date' => $expiration_date,
            'state' => 'ACTIVE'
        ]);

    return [
        'session_id' => $session_id,
        'user_id' => $user_id
    ];


}