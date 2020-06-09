<?php
/**
 * @var tpl_company_tpl\tpl_project_tpl\site\PageTemplate $template
 **/
?>
<!doctype html>
<html lang="es">
<head>
    <?php $template->getCommon() ?>
</head>
<body>
<h1>It works!</h1>
<form id="sum">
    <input type="number" name="a" value="2"/>
    <input type="number" name="b" value="2"/>
</form>
<button onclick="sum()">Sumar</button>
<script>
async function sum() {
    let sum = page.get('sum').value;
    const response = await fetch('<?=$this->url('ws/ws.php')?>?method=sum&a=' + sum.a + '&b=' + sum.b , {
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
</body>
</html>