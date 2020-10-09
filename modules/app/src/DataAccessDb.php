<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\app;

use labo86\rdtas\app\Config;
use labo86\rdtas\pdo\Util as UtilPDO;


class DataAccessDb extends \labo86\rdtas\app\DataAccessDb
{

    public function __construct(Config $global_config) {
        $config = $global_config->getDatabase('db');
        parent::__construct($config);
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