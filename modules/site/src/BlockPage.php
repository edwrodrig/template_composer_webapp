<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\site;

use labo86\exception_with_data\ExceptionWithData;
use labo86\staty_core\PageFile;
use labo86\staty_core\PageString;
use labo86\staty_core\SourceFile;

class BlockPage extends Block
{
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
    public function htmlHeadCommon() {

        $lib_js = new PageFile(new SourceFile(__DIR__ . '/../../site_res/dist/index.min.js') , 'bundle/index.min.js');
        ?>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="<?=$this->makePage($lib_js)?>"></script>
        <?php
    }

    public function getTitle() : string {
        return $this->page->getMetadata()['title'] ?? '';
    }

    public function getDescription() : string {
        return $this->page->getMetadata()['description'] ?? '';
    }

    /**
     * @return string
     */
    public function service() : string {
        $php_include = sprintf("<?php\ninclude \"%s\";", realpath(__DIR__ . '/../../controller/www/ws.php'));
        $link = new PageString($php_include, 'controller/ws.php');
        return $this->makePage($link);
    }
}