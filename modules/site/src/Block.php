<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\site;

use labo86\staty_core\Util;

class Block extends \labo86\staty\Block
{

    public function url(string $relative_path) : string {
        $from = $this->page->getRelativeFilename();
        $init_char = $from[0] ?? '';
        if ( $init_char == '/')
            return $this->page->getContext()->getAbsolutePath() . $relative_path;
        else
            return Util::getRelativePath($from, $relative_path);
    }
}