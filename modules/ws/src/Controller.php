<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\ws;

use labo86\hapi_core\Request;
use labo86\hapi_core\Response;
use labo86\hapi_core\ResponseJson;
use tpl_company_tpl\tpl_project_tpl\model\Sum;

class Controller extends \labo86\hapi\Controller
{
    public function __construct() {
        parent::__construct();

        $this->getServiceMap()
            ->registerService('sum', function(Request $request) : Response {
                $params = $request->getParams();
                $sum = new Sum();
                $result = $sum->do($params['a'], $params['b']);
                return new ResponseJson(["result" => $result]);
            });
    }

}