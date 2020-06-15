<?php
declare(strict_types=1);

use tpl_company_tpl\tpl_project_tpl\controller\Controller;

include_once(__DIR__ . '/../../../vendor/autoload.php');

$_ENV['ERROR_LOG_FILENAME'] = __DIR__ . '/../error_log';

(new Controller())->run();