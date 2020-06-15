<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\site;

use labo86\exception_with_data\ExceptionWithData;
use labo86\staty_core\Context;
use labo86\staty_core\Generator;
use labo86\staty_core\ReaderDirectory;

class Builder
{
    /**
     * Tanto el source como el target solo se concatenan, tener cuidado por el momento
     * @param string $source_dir
     * @param string $target_dir
     * @throws ExceptionWithData
     */
    public function makeSite(string $source_dir, string $target_dir) {
        setlocale(LC_ALL, 'es_CL.utf-8');
        $context = new Context();

        $reader = new ReaderDirectory($context, $source_dir);
        foreach ( $reader->readPages() as $page )
            $context->prepare($page);

        $generator = new Generator($target_dir);
        $generator->setPageList($context->getPreparedPageList());
        $generator->generate();

    }
}