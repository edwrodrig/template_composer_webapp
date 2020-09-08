<?php
declare(strict_types=1);

use labo86\exception_with_data\ExceptionWithData;
use tpl_company_tpl\tpl_project_tpl\site\Builder;

require_once(__DIR__ . '/../vendor/autoload.php');

try {
    $builder = new Builder();
    $builder->makeSite(__DIR__ . '/../data/html', __DIR__ . '/../var/www');
} catch ( ExceptionWithData $exception ) {
    echo $exception->getMessage(), "\n";
    echo json_encode($exception->getData(),JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE), "\n";
    echo $exception->getFile() , ":" , $exception->getLine() ,"\n";
    echo json_encode($exception->getTrace(),JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE), "\n";
} catch ( Throwable $exception ) {
    echo $exception->getMessage(), "\n";
    echo $exception->getFile() , ":" , $exception->getLine() ,"\n";
    echo json_encode($exception->getTrace(),JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE), "\n";
}