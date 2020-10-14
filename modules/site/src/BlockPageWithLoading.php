<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\site;

use labo86\rdtas\staty\BlockPageModuleTrait;

class BlockPageWithLoading extends BlockPage
{
    use BlockPageModuleTrait;

    public function sectionBeginHeadAddition() {
        $this->sectionBegin('head_additional');
    }

    public function sectionBeginBodyContent()  {
        $this->sectionBegin('body_content');
    }

    /**
     * Esto va justo antes de cerrar el tag body
     */
    public function sectionLastBodyContent() {
        $this->sectionBegin('last_body_content');
    }

    public function html() {
        $this->sectionEnd();?>
<!doctype html>
<html lang="es">
<head>
    <?php $this->htmlHeadCommon() ?>
    <title><?=$this->getTitle()?></title>
    <?=$this->getSectionContent('head_additional')?>
</head>
<body>
    <div id="loading_process" class="tab-content">
        <div data-id="loading_screen" class="tab-pane pt-5 active" role="tabpanel">
            <div class="container text-center">
                <h3>Cargando...</h3>
            </div>
        </div>
        <div data-id="loaded_screen" class="tab-pane" role="tabpanel">
            <?=$this->getSectionContent('body_content')?>
        </div>
    </div>
    <?=$this->getSectionContent('last_body_content')?>
</body>
</html>
<?php
    }

}