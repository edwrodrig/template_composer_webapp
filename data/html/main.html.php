<?php
declare(strict_types=1);

use labo86\staty_core\PagePhp;
use tpl_company_tpl\tpl_project_tpl\site\BlockPage;

/** @var PagePhp $page **/
$page->prepareMetadata([
    'title' => 'tpl_project_tpl - Principal',
    'description' => 'Pantalla principal'
]);

$BLOCK = new BlockPage($page);

$screen_components = $BLOCK->loadModuleComponents('main');

$BLOCK->sectionBeginHeadAddition(); ?>
<?php $BLOCK->sectionBeginBodyContent(); ?>
<nav class="navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="/images/logo/logo60x60.png" width="30" height="30" class="d-inline-block align-top" alt="">
        <?=$BLOCK->getAppName()?>
    </a>
    <ul id="nav" class="nav nav-pills ml-auto">
        <?php foreach( $screen_components as $component ) : ?>
            <li class="nav-item">
                <a class="nav-link" href="#" role="tab" aria-controls="<?=$component->getId()?>"><?=$component->getLabel()?></a>
            </li>
        <?php endforeach;?>
    </ul>
    <button id="logout_button" class="btn btn-outline-secondary ml-3">Salir</button>
</nav>
<div class="container">
    <div id="screen_contents" class="tab-content">
        <?php foreach( $screen_components as $component ) : ?>
            <div data-id="<?=$component->getId()?>" class="tab-pane pt-5" role="tabpanel">
                <?php $component->import('html') ?>
            </div>
        <?php endforeach;?>
    </div>
</div>
<?php $BLOCK->htmlFooter()?>
<?php $BLOCK->import('snack_bar.html')?>
    <script>
        <?php $BLOCK->importComponent(
            'Element',
            'SnackBar',
            'Page',
            'Button',
            'Table',
            'Form',
            'TabConnector',
            'SectionEasyServices')?>


        let page = new Page();
        page.button('logout').click(function() {
            page.logout();
        });

        let screens = new TabConnector();
        screens.add_buttons('nav');
        screens.add_contents('screen_contents');

        let endpoint = '<?=$BLOCK->service()?>';

        <?php foreach( $screen_components as $component )
            $component->import('js');
        ?>

        screens.update('fruit_screen');
    </script>
<?php
$BLOCK->html();