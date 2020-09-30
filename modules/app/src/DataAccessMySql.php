<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\app;

use labo86\rdtas\app\User;
use labo86\rdtas\pdo\Util as UtilPDO;
use PDO;

class DataAccessMySql
{

    public string $database_name = 'tpl_company_tpl_tpl_project_tpl';

    public string $database_user = 'tpl_company_tpl_tpl_project_tpl_app_user';

    public string $database_password = 'password';

    private PDO $pdo;

    public string $file_directory = __DIR__ . '/../../../var/files';

    public function setPDO(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getPDO() : PDO {
        if ( !isset($this->pdo) ) {
            $this->pdo = new PDO(sprintf('sqlite:%s', __DIR__ . '/../../../var/test.db'));
            //$this->pdo = new PDO(UtilPDO::mysqlDns($this->database_name), $this->database_user, $this->database_password);
        }
        return $this->pdo;
    }

    public function createDatabase() {
        $pdo = $this->getPDO();
        $schema = file_get_contents(__DIR__ . '/../../../scripts/ddl_tables.sql');
        $stmt = $pdo->exec($schema);
        $user_id = uniqid();
        User::createUser($pdo, $user_id, 'admin', password_hash('pass', PASSWORD_DEFAULT));
        User::setUserType($pdo, $user_id, 'ADMIN');
    }

    public function getFileDirectory() : string {
        return \labo86\rdtas\Util::createDirectory($this->file_directory);
    }

    public function getSession(string $session_id) : array {
        $pdo = $this->getPDO();

        $row = UtilPDO::selectRow($pdo, 'SELECT user_id, creation_date, expiration_date, state FROM sessions WHERE session_id = :session_id', [
            'session_id' => $session_id
        ]);

        return $row;
    }

    public function getUser(string $user_id) : array {
        $pdo = $this->getPDO();

        $row = UtilPDO::selectRow($pdo, 'SELECT user_id, name FROM users WHERE user_id = :user_id', [
            'user_id' => $user_id
        ]);

        return $row;
    }
}