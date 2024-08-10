<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter web application</title>

    {if $env === 'local'}
        <script type="module" src="http://localhost:5173/@vite/client"></script>
    {/if}
    {include file="components/insert_assets.tpl" asset_path="assets/js/main.ts"}
</head>
<body class="bg-light">
    {block name=content}{/block}
</body>
</html>