<?php
declare(strict_types=1);

use tpl_company_tpl\tpl_project_tpl\site\BlockPageWithLoading;
use labo86\staty_core\PagePhp;

/** @var PagePhp $page **/
$page->prepareMetadata([
'title' => 'tpl_project_tpl - Principal',
'description' => 'Pantalla principal'
]);

$BLOCK = new BlockPageWithLoading($page);
?>
<?php $BLOCK->sectionLastBodyContent(); ?>
<?php $BLOCK->htmlFooter()?>
<?php $BLOCK->import('snack_bar.html')?>
<script>
    <?php $BLOCK->importComponent(
        'Element',
        'SnackBar',
        'Page',
        'TabConnector')?>

    let endpoint = '<?=$BLOCK->service()?>';

    let page = new Page();

    page.check_session(async function (session) {
        window.location.href = '/main.html';
    });

</script>
<?php
$BLOCK->html();