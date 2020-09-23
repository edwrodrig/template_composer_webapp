<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\app;

use labo86\rdtas\pdo\Util as UtilPDO;
use PDO;

class DataAccessMySql extends DataAccess
{

    public string $database_name = 'tpl_company_tpl_tpl_project_tpl';

    public string $database_user = 'tpl_company_tpl_tpl_project_tpl_app_user';

    public string $database_password = 'password';

    private PDO $pdo;

    public function getPDO() : PDO {
        if ( !isset($this->pdo) )
            $this->pdo = new PDO(UtilPDO::mysqlDns($this->database_name), $this->database_user, $this->database_password);
        return $this->pdo;
    }

    public function createDatabase() {
        $pdo = $this->getPDO();
        $schema = file_get_contents(__DIR__ . '/../../../scripts/schema.sql');
        $stmt = UtilPDO::prepare($pdo, $schema);
        UtilPDO::execute($stmt);
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