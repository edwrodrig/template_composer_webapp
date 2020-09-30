<?php
declare(strict_types=1);

use labo86\staty_core\PagePhp;
use tpl_company_tpl\tpl_project_tpl\site\BlockPage;

/** @var PagePhp $page **/
$page->prepareMetadata([
    'title' => 'tpl_project_tpl - Administración',
    'description' => 'Servicios de administración'
]);

$BLOCK = new BlockPage($page);

$BLOCK->sectionBeginHeadAddition();?>
<?php $BLOCK->sectionBeginBodyContent(); ?>
<nav class="navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="/images/logo/logo60x60.png" width="30" height="30" class="d-inline-block align-top" alt="">
        <?=$BLOCK->getAppName()?>
    </a>
    <ul id="nav" class="nav nav-pills ml-auto">
        <li class="nav-item">
            <a class="nav-link active" href="#" role="tab" aria-controls="tab_pane_errors">Errores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" role="tab" aria-controls="tab_pane_users">Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" role="tab" aria-controls="tab_pane_server">Servicios</a>
        </li>
    </ul>
    <button id="logout_button" class="btn btn-outline-secondary ml-3">Salir</button>
</nav>
<div class="container">
    <div id="tab_contents" class="tab-content">
        <div id="tab_pane_errors" class="tab-pane pt-5 active" role="tabpanel">
            <?php $BLOCK->import('admin/error_table.html') ?>
        </div>
        <div id="tab_pane_users" class="tab-pane pt-5" role="tabpanel">
            <?php $BLOCK->import('admin/users.html') ?>
        </div>
        <div id="tab_pane_server" class="tab-pane pt-5" role="tabpanel">
            <h3>Servicios de administrador</h3>
            <div id="tab_pane_services_admin">
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

let nav = new TabControls('nav');
nav.connect_contents('tab_contents')

let endpoint = '<?=$BLOCK->service()?>';

<?php $BLOCK->import('admin/error_table.js') ?>
<?php $BLOCK->import('admin/users.js') ?>

let section_easy_services = new SectionEasyServices('tab_pane_services_admin');
section_easy_services.add_services(endpoint + '?method=get_services_admin');
</script>
<?php
$BLOCK->html();