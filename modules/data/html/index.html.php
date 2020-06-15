<?php
declare(strict_types=1);

use labo86\staty_core\PagePhp;
use tpl_company_tpl\tpl_project_tpl\site\BlockPage;

/** @var PagePhp $page **/
$page->prepareMetadata([
    'title' => 'tpl_project_tpl',
    'description' => 'Mi super asombrosa webapp'
]);

$BLOCK = new BlockPage($page);

$BLOCK->sectionBeginHeadAddition();
?>
<script>
    async function sum() {
        let sum = page.get('sum').value;
        const response = await fetch('<?=$BLOCK->service()?>?method=sum&a=' + sum.a + '&b=' + sum.b , {
            method: 'GET', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
                'Content-Type': 'application/json'
                // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', // manual, *follow, error
            referrer: 'no-referrer', // no-referrer, *client
        });
        alert((await response.json()).result);
    }
</script>
<?php $BLOCK->sectionBeginBodyContent(); ?>
<h1>It works!</h1>
<form id="sum">
    <label>
        <input type="number" name="a" value="2"/>
    </label>
    <label>
        <input type="number" name="b" value="2"/>
    </label>
</form>
<button onclick="sum()">Sumar</button>
<?php
$BLOCK->html();