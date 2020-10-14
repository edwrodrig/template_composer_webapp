<?php
declare(strict_types=1);

use labo86\staty_core\PagePhp;
use tpl_company_tpl\tpl_project_tpl\site\BlockPage;

/** @var PagePhp $page **/
$page->prepareMetadata([
    'title' => 'tpl_project_tpl - Ingreso',
    'description' => 'Ingresa a nuestra formidable aplicación'
]);

$BLOCK = new BlockPage($page);

$BLOCK->sectionBeginHeadAddition(); ?>
<?php $BLOCK->sectionBeginBodyContent(); ?>
    <div class="container" style="max-width:500px">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="/images/logo/logo300x300.png" alt="" width="72" height="72">
            <h2><?=$BLOCK->getAppName()?></h2>
            <p class="lead">Un asombroso sistema</p>
        </div>
        <form id="login_form">
            <div class="form-group">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Nombre de usuario">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Contraseña">
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" data-id="submit" data-waiting-text="Ingresando..." data-ready-text="Ingresar">Ingresar</button>
                </div>
            </div>
        </form>
    </div>
<?php $BLOCK->htmlFooter();?>
<?php $BLOCK->import('snack_bar.html')?>
    <script>
        <?php $BLOCK->importComponent(
            'Element',
            'SnackBar',
            'Page',
            'Button',
            'Form')?>

        let page = new Page();

        let endpoint = '<?=$BLOCK->service()?>';

        let form = new Form('login_form');
        form.button('submit').click(async function() {
            let button = form.button('submit');
            let form_data = form.form_data;
            form_data.set('method', 'create_session');

            button.set_status_waiting();
            form.set_disabled(true);
            try {
                const response = await page.fetch(endpoint, form_data);

                localStorage.username = form_data.get('username');
                window.location.href = '/main.html';
                button.set_label('Redirigiendo...');

            } catch (exception) {
                await page.handle_exception(exception);
                button.set_status_ready();
                form.set_disabled(false);
            }
        });

    </script>
<?php
$BLOCK->html();