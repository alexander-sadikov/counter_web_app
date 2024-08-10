<?php
declare(strict_types=1);

namespace App;

use Smarty\Smarty;

class View
{
    private static function create_smarty(): Smarty{
        // Set up Smarty
        $smarty = new Smarty();

        $smarty->setTemplateDir(APP_DIR . '/templates');
        $smarty->setCompileDir(APP_DIR . '/templates_c');
        $smarty->escape_html = true;

        return $smarty;
    }

    public static function render(string $view, array $params = []): string{
        $smarty = self::create_smarty();
        $smarty->assign([
            'dist_manifest' => Config::distManifest(),
            'env' => ENV,
            ...$params
        ]);
        return $smarty->fetch('extends:index.tpl|' . $view);
    }
}