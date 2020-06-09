<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\site;

use labo86\staty_core\PageTemplate as PageTemplateBase;

class PageTemplate extends PageTemplateBase
{

    public function url(string $relative_path) : string {
        return $this->getContext()->getAbsolutePath() . '/'. $relative_path;
    }

    public function getCommon() {?>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="<?=$this->url('bundle/index.min.js')?>"></script>
        <title>tpl_project_tpl</title>
        <?php
    }


}