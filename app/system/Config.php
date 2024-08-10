<?php
declare(strict_types=1);

namespace App;

use App\Exceptions\NotValidEnvironmentException;

class Config
{
    /**
     * @throws NotValidEnvironmentException
     */
    public static function getEnv(): string{
        $env = getenv('ENV');

        if(!in_array($env, ['dev', 'local']))
            throw new NotValidEnvironmentException;

        return $env;
    }

    private static function distManifestPath(): string{
        return PUBLIC_DIR . '/dist/.vite/manifest.json';
    }

    public static function distManifest(): ?array{
        $manifest_path = self::distManifestPath();

        if(!file_exists($manifest_path))
            return null;

        return json_decode(file_get_contents($manifest_path), true);
    }
}