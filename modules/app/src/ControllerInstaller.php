<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\app;

use labo86\rdtas\app\DataAccessError;

class ControllerInstaller extends \labo86\rdtas\app\ControllerInstaller
{

    function prepareDataStores()
    {
        $this->prepareDataAccessDb(new \labo86\rdtas\app\DataAccessDb($this->getConfig()->getDatabase('db')));
        $this->prepareDataAccessFolder(new DataAccessError($this->getConfig()));
    }
}