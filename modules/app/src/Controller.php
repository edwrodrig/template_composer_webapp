<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\app;

use labo86\exception_with_data\ExceptionWithData;
use labo86\exception_with_data\MessageMapperArray;
use labo86\rdtas\app\ConfigDefault;
use labo86\rdtas\app\DataAccessError;
use labo86\rdtas\app\ServicesBasic;
use labo86\rdtas\hapi\Util;
use ReflectionException;

class Controller extends \labo86\hapi\Controller
{

    public array $msg_array = [
        \labo86\rdtas\ErrMsg::WRONG_PASSWORD => ErrMsgFrontEnd::WRONG_USER_OR_PASSWORD,
        \labo86\rdtas\ErrMsg::USER_DOES_NOT_EXIST => ErrMsgFrontEnd::WRONG_USER_OR_PASSWORD,
    ];

    /**
     * Controller constructor.
     * @throws ReflectionException
     * @throws ExceptionWithData
     */
    public function __construct() {
        parent::__construct();
        $this->setMessageMapper(new MessageMapperArray($this->msg_array));

        Util::registerAutomaticMethodService($this, __DIR__ . '/../../../data/services/services_user.php', 'get_services_user');
        //Util::registerAutomaticMethodService($this, __DIR__ . '/../../../data/services/services_admin.php', 'get_services_admin');

        $services  = new class extends ServicesBasic {
            public function getDataAccessUser(): DataAccessDb
            {
                return new DataAccessDb(new ConfigDefault());
            }

            public function getDataAccessError(): DataAccessError
            {
                return new DataAccessError(Controller::getConfigDefault());
            }
        };

        $services->registerServicesServer($this);
        $services->registerServicesUser($this);
        $services->registerServicesUserAdmin($this);

        $this->setErrorLogFilename($services->getDataAccessError()->getLogFilename());
    }

    public static function getConfigDefault() : ConfigDefault {
        ConfigDefault::loadDataFromFile(__DIR__ . '/../../../var/config.json');
        return new ConfigDefault();
    }

}