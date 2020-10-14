<?php
declare(strict_types=1);

namespace test\tpl_company_tpl\tpl_project_tpl\app;

use tpl_company_tpl\tpl_project_tpl\app\ControllerInstaller;
use labo86\rdtas\testing\TestControllerTrait;
use tpl_company_tpl\tpl_project_tpl\app\Controller;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    use TestControllerTrait;
    public function setUp(): void
    {
        $this->setUpTestFolder(__DIR__);
    }


    public function getController() : \tpl_company_tpl\tpl_project_tpl\app\Controller
    {
        \labo86\rdtas\app\ConfigDefault::setDefaultData([
            'db' => [
                'type' => 'sqlite',
                'name' => $this->getTestFolder() . '/db.sql',
                'schema' => __DIR__ . '/../../../scripts/ddl_tables.sql'
            ],
            'error' => [
                'dir' => $this->getTestFolder() . '/log'
            ]
        ]);

        $installer = new ControllerInstaller(Controller::getConfigDefault());

        $controller =  new Controller();
        $installer->prepareDataStores();

        return $controller;

    }

    public function testLoginLogoutWorkFlow() {
        $controller = $this->getController();

        $user = $this->makeRequest($controller, [
                'method' => 'create_session', 'username' => 'admin' , 'password' => 'pass'
            ]
        );
        $this->assertArrayHasKey('session_id', $user);

        $session_id = $user['session_id'];

        $user = $this->makeRequest($controller, [
                'method' => 'close_session', 'session_id' => $session_id
            ]
        );

        $this->assertNoErrorLogged();

    }
}
