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
    <div id="tab_pane_users" class="tab-pane" role="tabpanel">
        <h3 class="mt-5">Session Id actual</h3>
        <form id="session_id_form" class="form-inline">
            <div class="form-group flex-grow-1">
                <input type="text" name="session_id" class="form-control w-100" readonly>
            </div>
            <button type="submit" class="btn btn-primary ml-3">Obtener</button>
        </form>
        <h3 class="mt-5">Crear usuario</h3>
        <form id="create_user_form">
            <div class="form-group">
                <label class="sr-only">Nombre de usuario</label>
                <input type="text" name="username" class="form-control" placeholder="usuario">
            </div>
            <div class="form-group">
                <label class="sr-only">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="contraseña">
            </div>
            <button type="submit" class="btn btn-primary" data-waiting-text="Creando..." data-ready-text="Crear usuario">Crear usuario</button>
        </form>
        <h3 class="mt-5">Cambiar tipo de usuario</h3>
        <form id="set_user_type_form">
            <div class="form-group">
                <label class="sr-only">Nombre de usuario</label>
                <input type="text" name="username" class="form-control" placeholder="usuario">
            </div>
            <div class="form-group">
                <label class="sr-only">Contraseña</label>
                <input type="password" name="type" class="form-control" placeholder="type">
            </div>
            <button type="submit" class="btn btn-primary" data-waiting-text="Cambiando..." data-ready-text="Cambiar">Cambiar</button>
        </form>
        <h3 class="mt-5">Cambiar contraseña de usuario</h3>
        <form id="set_user_password_form">
            <div class="form-group">
                <label class="sr-only">Nombre de usuario</label>
                <input type="text" name="username" class="form-control" placeholder="usuario">
            </div>
            <div class="form-group">
                <label class="sr-only">Nuevas Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="nueva contraseña">
            </div>
            <button type="submit" class="btn btn-primary" data-waiting-text="Cambiando..." data-ready-text="Cambiar">Cambiar</button>
        </form>
    </div>
    <div id="tab_pane_errors" class="tab-pane active pt-5" role="tabpanel">
        <div class="d-flex d-column mb-2">
            <button id="update_error_list_button" class="btn btn-primary" data-waiting-text="Actualizando..." data-ready-text="Actualizar">Actualizar</button>
            <form id="get_error_form" class="form-inline ml-auto">
                <div class="form-group">
                    <label class="sr-only">Error id</label>
                    <input type="text" name="error_id" class="form-control" placeholder="codigo">
                </div>
                <button type="submit" class="btn btn-primary ml-3" data-waiting-text="Buscando..." data-ready-text="Buscar">Buscar</button>
            </form>
        </div>
        <table id="error_table" class="table">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Mensage usuario</th>
                    <th>Mensaje desarrollo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <template id="error_table_row">
            <tr>
                <td data-role="error_id"></td>
                <td data-role="user_msg"></td>
                <td data-role="dev_msg"></td>
                <td><a class="btn btn-secondary" data-role="link" target="_blank">Ver</a></td>
            </tr>
        </template>
    </div>
    <div id="tab_pane_server" class="tab-pane pt-5" role="tabpanel">
        <h3>Servicios de administrador</h3>
        <div id="tab_pane_services_admin" class="tab-pane" role="tabpanel">
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
let error_table = new Table('error_table');
let nav = new TabControls('nav');
let tab_contents = new TabContents('tab_contents');

let create_user_form = new Form('create_user_form');
let set_user_type_form = new Form('set_user_type_form');
let set_user_password_form = new Form('set_user_password_form');
let get_error_form = new Form('get_error_form');
let update_error_list_button = new Button('update_error_list_button');

let endpoint = '<?=$BLOCK->service()?>';
let session_id = page.get_session_id();

let session_id_form = new Form('session_id_form');

session_id_form.submit_button.add_click_listener(function() {
   let form = session_id_form;
   form.element.elements['session_id'].value = page.get_session_id();

   navigator.clipboard.writeText(page.get_session_id());

   page.snack_bar.show_success('Session id copiado al portapapeles');

});

page.bind_button(create_user_form.submit_button,
    function(form_data)
    {
        form_data.set('method', 'create_user');
        form_data.set('session_id', page.get_session_id())
    },
    function(json) {
        let form = create_user_form;
        page.snack_bar.show_success('Usuario creado!');
        form.set_disabled(false);
        form.submit_button.set_status_ready();
    }
);

page.bind_button(set_user_type_form.submit_button,
    function(form_data) {
        form_data.set('method', 'set_user_type');
        form_data.set('session_id', page.get_session_id())
    },
    function(json) {
        let form = set_user_type_form;
        page.snack_bar.show_success('Cambio de tipo de usuario exitoso!');
        form.set_disabled(false);
        form.submit_button.set_status_ready();
    }
);

page.bind_button(set_user_password_form.submit_button,
    function(form_data) {
        form_data.set('method', 'set_user_password');
        form_data.set('session_id', page.get_session_id())
    },
    function(json) {
        let form = set_user_password_form;
        page.snack_bar.show_success('Cambio de contraseña de usuario exitosa!');
        form.set_disabled(false);
        form.submit_button.set_status_ready();
    }
);

update_error_list_button.add_click_listener(function() {
    let button = update_error_list_button;
    button.set_status_waiting();
    fetch(endpoint + '?method=get_error_list&session_id=' + page.get_session_id())
    .then(page.handle(
        function(response) {
            for ( let error of response ) {
                let error_id = error.i
                let user_msg = error.m;
                let dev_msg = '';
                if ( error.hasOwnProperty('p') )
                    dev_msg = error.p.m;
                let link = endpoint + '?method=get_error_by_error_id&session_id=' + page.get_session_id() + '&error_id=' + error_id;

                let row = new Element(Element.importNode('error_table_row'));
                row.get_element_by_role('error_id').textContent = error_id;
                row.get_element_by_role('user_msg').textContent = user_msg;
                row.get_element_by_role('dev_msg').textContent = dev_msg;
                row.get_element_by_role('link').href = link;

                error_table.body.appendChild(row.element);
            }

            button.set_status_ready();
        },
        function(json) {
            page.handle_error(json);
            button.set_status_ready();
        }
    ))
});

page.bind_button(get_error_form.submit_button,
    function(form_data) {
        form_data.set('method', 'get_error_by_error_id');
        form_data.set('session_id', page.get_session_id());
    },
    function(response) {
        let form = get_error_form;
        form.submit_button.set_status_ready();
        form.set_disabled(false);
        window.open("data:application/json," + encodeURIComponent(JSON.stringify(response)),"_blank");
    });

nav.add_select_listener(function(id) {
    tab_contents.change_page(id);
});

let logout_button = new Button('logout_button');
logout_button.add_click_listener(function() {
    page.logout();
})

let section_easy_services = new SectionEasyServices('tab_pane_services_admin');
section_easy_services.add_services(endpoint + '?method=get_services_admin');
section_easy_services.add_services(endpoint + '?method=get_services_user');
</script>
<?php
$BLOCK->html();