<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\site;

use labo86\exception_with_data\ExceptionWithData;
use labo86\rdtas\staty\BlockPageModuleTrait;
use labo86\staty_core\PageFile;
use labo86\staty_core\PageString;
use labo86\staty_core\SourceFile;

class BlockPage extends \labo86\rdtas\staty\Block
{
    use BlockPageModuleTrait;

    public function sectionBeginHeadAddition() {
        $this->sectionBegin('head_additional');
    }

    public function sectionBeginBodyContent()  {
        $this->sectionBegin('body_content');
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
    <?=$this->getSectionContent('body_content')?>
</body>
</html>
<?php
    }

    /**
     * @throws ExceptionWithData
     */
    public function htmlHeadCommon() {?>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="/images/logo/logo32x32.png" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <?php
    }

    public function getTitle() : string {
        return $this->page->getMetadata()['title'] ?? '';
    }

    public function getDescription() : string {
        return $this->page->getMetadata()['description'] ?? '';
    }

    public function service() : string {
        $php_include = sprintf("<?php\ninclude \"%s\";", realpath(__DIR__ . '/../../../data/services/ws.php'));
        $link = new PageString($php_include, 'controller/ws.php');
        return $this->makePage($link);
    }

    public function getAppName() : string {
        return 'tpl_project_tpl';
    }

    public function getCopyrightText() : string {
        return sprintf('Edwin Rodríguez-León © %d',date('Y'));
    }

    public function htmlFooter() {?>
        <footer class="text-center mt-5">
            <img src="/images/labo86_black_letter_400x128.png" width="120">
            <p class="mt-2 text-secondary small"><?=$this->getCopyrightText()?></p>
        </footer>
        <?php
    }
}