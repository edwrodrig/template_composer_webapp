<?php
declare(strict_types=1);

namespace test\tpl_company_tpl\tpl_project_tpl\app;

use labo86\exception_with_data\ExceptionWithData;
use labo86\hapi_core\Request;
use labo86\hapi_core\ResponseJson;
use tpl_company_tpl\tpl_project_tpl\app\Controller;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    /**
     * @throws ExceptionWithData
     */
    public function testBasic() {
        $controller = new Controller();

        $request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getParams'])
            ->getMock();

        $request->expects($this->any())
            ->method('getParameterList')
            ->willReturn(['a' => 2 , 'b' => 2]);

        $service = $controller->getServiceMap()->getService('sum');
        $response = $service($request);

        $this->assertInstanceOf(ResponseJson::class, $response);

    }
}
