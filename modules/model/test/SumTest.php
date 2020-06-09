<?php
declare(strict_types=1);

namespace test\tpl_company_tpl\tpl_project_tpl\model;

use tpl_company_tpl\tpl_project_tpl\model\Sum;
use PHPUnit\Framework\TestCase;

class SumTest extends TestCase
{

    public function testDoBasic()
    {
        $sum = new Sum();
        $this->assertEquals(4, $sum->do(2, 2));

    }
}
