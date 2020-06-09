<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\ws;

use labo86\hapi_core\Request;
use labo86\hapi_core\Response;
use labo86\hapi_core\ResponseJson;

class Controller extends \labo86\hapi\Controller
{
    public function __construct() {
        parent::__construct();

        $this->getServiceMap()
            ->registerService('sum', function(Request $request) : Response {
                $params = $request->getParams();
                return new ResponseJson(["result" => $params['a'] + $params['b']]);
            });
    }

}