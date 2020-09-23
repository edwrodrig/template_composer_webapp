<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\app;

use labo86\exception_with_data\ExceptionWithData;
use labo86\hapi_core\Request;
use labo86\hapi_core\Response;
use labo86\hapi_core\ResponseJson;
use labo86\rdtas\hapi\Util;
use ReflectionException;

class Controller extends \labo86\hapi\Controller
{
    /**
     * Controller constructor.
     * @throws ReflectionException
     * @throws ExceptionWithData
     */
    public function __construct() {
        parent::__construct();

        Util::registerAutomaticMethodService($this, __DIR__ . '/../../../data/services/services_user.php', 'get_services_user');
        Util::registerAutomaticMethodService($this, __DIR__ . '/../../../data/services/services_admin.php', 'get_services_admin');

        $this->getServiceMap()
            ->registerService('sum', function(Request $request) : Response {
                $a = $request->getIntParameter('a');
                $b = $request->getIntParameter('b');

                $result = $a + $b;
                return new ResponseJson(["result" => $result]);
            });
    }

}