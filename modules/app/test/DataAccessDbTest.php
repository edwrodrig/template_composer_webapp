<?php
declare(strict_types=1);

namespace test\tpl_company_tpl\tpl_project_tpl\app;

use tpl_company_tpl\tpl_project_tpl\app\DataAccessDb;
use PHPUnit\Framework\TestCase;

class DataAccessDbTest extends TestCase
{

    private $path;

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


    public function testLoadSaveTournamentBasic()
    {
        $dao = new DataAccessDb();

    }
}
