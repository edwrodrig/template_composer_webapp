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

$BLOCK->sectionBeginHeadAddition(); ?>
<?php $BLOCK->sectionBeginBodyContent(); ?>
<nav class="navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="/images/logo/logo60x60.png" width="30" height="30" class="d-inline-block align-top" alt="">
        <?=$BLOCK->getAppName()?>
    </a>
    <ul id="tab_controls" class="nav nav-pills ml-auto">
        <li class="nav-item">
            <a class="nav-link active" href="#" role="tab" aria-controls="tab_pane_fruits">Frutas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" role="tab" aria-controls="tab_pane_hello">Saludar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" role="tab" aria-controls="tab_pane_server">Servicios</a>
        </li>
    </ul>
    <button id="logout_button" class="btn btn-outline-secondary ml-3">Salir</button>
</nav>
<div class="container">
<div id="tab_contents" class="tab-content">
    <div id="tab_pane_fruits" class="tab-pane pt-5 active" role="tabpanel">
        <?php $BLOCK->import('main/fruit_table.html')?>
    </div>
    <div id="tab_pane_hello" class="tab-pane pt-5" role="tabpanel">
        <?php $BLOCK->import('main/hello_form.html')?>
    </div>
    <div id="tab_pane_server" class="tab-pane pt-5" role="tabpanel">
        <h3>Servicios de usuario</h3>
        <div id="tab_pane_services_user">
        </div>
    </div>
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
        'TabControls',
        'TabContents',
        'SectionEasyServices')?>

let page = new Page();
    page.connect_logout_button('logout_button');
let tab_controls = new TabControls('tab_controls');
    tab_controls.connect_contents('tab_contents');

let endpoint = '<?=$BLOCK->service()?>';

<?php $BLOCK->import('main/fruit_table.js') ?>
<?php $BLOCK->import('main/hello_form.js') ?>

let section_easy_services = new SectionEasyServices('tab_pane_services_user');
section_easy_services.add_services(endpoint + '?method=get_services_user');
</script>
<?php
$BLOCK->html();