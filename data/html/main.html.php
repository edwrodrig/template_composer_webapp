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
    <div id="tab_pane_fruits" class="tab-pane active" role="tabpanel">
        <table id="fruit_table" class="table">
            <thead>
            <tr>
                <th>Nombre</th><th>Color</th><th></th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
        <template id="fruit_table_row">
            <tr>
                <td data-role="name"></td>
                <td data-role="color"></td>
                <td><a class="btn btn-secondary" data-role="link" target="_blank">Ver</a></td>
            </tr>
        </template>
    </div>
    <div id="tab_pane_hello" class="tab-pane" role="tabpanel">
        <h3>Saludar</h3>
        <form id="hello_form">
            <div class="form-group">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="name" placeholder="Ingresa tu nombre">
                </div>
                <button class="btn btn-primary" type="submit" data-waiting-text="Saludando..." data-ready-text="Saludar">Saludar</button>
            </div>
        </form>
    </div>
    <div id="tab_pane_server" class="tab-pane pt-5" role="tabpanel">
        <h3>Servicios de usuario</h3>
        <div id="tab_pane_services" class="tab-pane" role="tabpanel">
        </div>
    </div>
</div>
</div>
<?php $BLOCK->htmlFooter()?>
<template id="snack_bar">
    <div class="container fixed-bottom">
        <div class="alert text-center" role="alert">
            <span data-role="message"></span>
            <button class="ml-3 btn btn-danger btn-sm d-none" data-role="close">Cerrar</button>
        </div>
    </div>
</template>
<script>
    <?php $BLOCK->getComponentJs(
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
let fruit_table = new Table('fruit_table');
let tab_controls = new TabControls('tab_controls');
let tab_contents = new TabContents('tab_contents');

tab_controls.add_select_listener(function(id) {
    tab_contents.change_page(id);
});

let logout_button = new Button('logout_button');
logout_button.add_click_listener(function() {
    page.logout();
})

let hello_form = new Form('hello_form');
page.bind_button(hello_form.submit_button,
    function(form_data) {
        form_data.set('method', 'say_hello');
        form_data.set('session_id', page.get_session_id());
    },
    function(response) {
        let form = hello_form;
        page.snack_bar.show_success(response);
        form.submit_button.set_status_ready();
        form.set_disabled(false);
    }
);

let section_easy_services = new SectionEasyServices('tab_pane_services');
section_easy_services.add_services(endpoint + '?method=get_services_host');



let endpoint = '<?=$BLOCK->service()?>';
let session_id = page.get_session_id();

fruit_table.set_message('Obteniendo frutas...');
fetch(endpoint + '?method=get_fruit_list&session_id=' + session_id)
    .then(page.handle(
        function(json) {
            fruit_table.clear();
            for ( let fruit of json ) {
                let name = fruit.name;
                let color = fruit.color;
                let link = fruit.link;

                let row = new Element(Element.importNode('fruit_table_row'));
                row.get_element_by_role('name').textContent = name;
                row.get_element_by_role('color').textContent = color;
                row.get_element_by_role('link').href = link;

                fruit_table.body.appendChild(row.element);
            }
        },
        function(json) {
            page.handle_error(json);
            page.logout();
        }));

</script>
<?php
$BLOCK->html();