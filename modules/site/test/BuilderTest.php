<?php
declare(strict_types=1);

namespace test\tpl_company_tpl\tpl_project_tpl\site;

use labo86\exception_with_data\ExceptionWithData;
use tpl_company_tpl\tpl_project_tpl\site\Builder;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    /**
     * @var false|string
     */
    private $path;

    public function setUp() : void {
        $this->path =  tempnam(__DIR__, 'demo');

        unlink($this->path);
        mkdir($this->path, 0777);
    }

    public function tearDown() : void {
        exec('rm -rf ' . $this->path);
    }

    /**
     * @throws ExceptionWithData
     */
    public function testMakeSiteBasic()
    {
        $target_dir = $this->path . '/www';
        $this->assertFileNotExists($target_dir);
        $builder = new Builder();
        $builder->makeSite(__DIR__ . '/../../../data/html', $target_dir);

        $this->assertDirectoryExists($target_dir);
    }
}
