<?php

namespace App\Libraries;

use mindplay\vite\Manifest;

class Vite
{
    private Manifest $manifest;

    public function __construct()
    {
        $isDev = getenv('CI_ENVIRONMENT') !== 'production';

        $this->manifest = new Manifest(
            manifest_path: FCPATH . 'dist/.vite/manifest.json',
            base_path: $isDev
                ? getenv('VITE_NODE_SERVER_ORIGIN') . '/'
                : '/dist/',
            dev: $isDev
        );
    }

    public function tags(string ...$entries)
    {
        return $this->manifest->createTags(...$entries);
    }

    public function url(string $asset): string
    {
        return $this->manifest->getURL($asset);
    }
}
