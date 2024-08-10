{if $env === 'local'}
    <script type="module" src="http://localhost:5173/{$asset_path}"></script>
{else}
    {$dist_asset = $dist_manifest[$asset_path]}

    {if $dist_asset.css}
        {foreach $dist_asset.css as $css_path}
            <link rel="stylesheet" type="text/css" href="/dist/{$css_path}">
        {/foreach}
    {/if}

    <script src="/dist/{$dist_asset['file']}" type="module"></script>
{/if}