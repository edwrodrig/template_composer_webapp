<?php
declare(strict_types=1);

namespace test\imo\tpl_project_tpl\model;

use tpl_company_tpl\tpl_project_tpl\model\CsvParser;
use PHPUnit\Framework\TestCase;

class CsvParserTest extends TestCase
{

    public function testGetLatitudeFromLine()
    {
        $this->assertEquals("-23.8208", CsvParser::getLatitudeFromLine("% Latitude : -23.8208"));

    }

    public function testGetLongitudeFromLine()
    {
        $this->assertEquals("-70.8361", CsvParser::getLongitudeFromLine("% Longitude : -70.8361"));
    }

    public function testsGetLocationFromFile() {
        $location = CsvParser::getLocationFromFile(__DIR__ . '/files/dSO261_01_002_.csv');
        $this->assertEquals(['lng' => -70.8354, 'lat' => -23.8167], $location);
    }
}
