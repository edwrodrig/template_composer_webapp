<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\site;

use labo86\staty_core\Context;
use labo86\staty_core\Generator;
use labo86\staty_core\ReaderDirectory;
use Exception;

class Builder
{
    /**
     * @throws Exception
     */
    public function makeSite() {


        exec(sprintf('rm -rf %s', escapeshellarg(__DIR__ . '/../www')));
        setlocale(LC_ALL, 'es_CL.utf-8');
        $context = new Context('');

        $reader = new ReaderDirectory($context, __DIR__ . '/../files');
        $pages = iterator_to_array($reader->readPages(), false);

        $generator = new Generator(__DIR__ . '/../www');
        $generator->setPageList($pages);
        $generator->generate();


        symlink (__DIR__ . '/../../ws/www', __DIR__ . '/../www/ws');

    }
}