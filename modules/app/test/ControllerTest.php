<?php
declare(strict_types=1);

namespace test\tpl_company_tpl\tpl_project_tpl\app;

use labo86\exception_with_data\ExceptionWithData;
use tpl_company_tpl\tpl_project_tpl\app\ConfigDefault;
use tpl_company_tpl\tpl_project_tpl\app\Controller;
use PHPUnit\Framework\TestCase;
use tpl_company_tpl\tpl_project_tpl\app\DataAccessDb;

class ControllerTest extends TestCase
{
    private array $service_record = [];

    public function setUp(): void
    {
        $this->path = tempnam(__DIR__, 'demo');

        unlink($this->path);
        mkdir($this->path, 0777);
    }

    public function tearDown(): void
    {
        exec('rm -rf ' . $this->path);
    }

    public function getController() : \labo86\battle_royale\app\Controller
    {
        $config = [
            'files' => [
                'type' => 'file_system',
                'db' => $this->path . '/file'
            ],
            'data' => [
                'type' => 'sqlite',
                'db' => $this->path . '/db.sql'
            ]
        ];

        ConfigDefault::setDefaultData($config);

        $dao = new DataAccessDb(new ConfigDefault());
        $dao->createTables();
        $controller =  new Controller();
        $controller->setErrorLogFilename($this->path . '/error_log');
        return $controller;

    }

    public function getErrorLog() : string {
        $error_log_file = $this->path . '/error_log';
        if ( file_exists($error_log_file) )
            return file_get_contents($error_log_file);
        else return "";
    }

    public function makeRequest(Controller $controller, array $parameters, array $file_parameters = [])  {
        $request = new \labo86\hapi\Request();
        $request->setParameterList($parameters);
        $request->setFileParameterList($file_parameters);
        $response = $controller->handleRequest($request);
        $data = $response->getData() ?? [];

        $this->service_record[] = [
            'request' => [
                'params' => $parameters,
                'file' => $file_parameters
            ],
            'response' => $data
        ];
        return $data;
    }
}
