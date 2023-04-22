<?php

namespace Zvn\Tools\Support;

use Illuminate\Config\Repository;
use Illuminate\Filesystem\Filesystem;

class Config extends Repository
{
    public function loadConfigFiles($path): void
    {
        $fileSystem = new Filesystem();
        if (!$fileSystem->isDirectory($path)) {
            return;
        }

        foreach ($fileSystem->allFiles($path) as $file) {
            $relativePathname = $file->getRelativePathname();
            $pathInfo = pathinfo($relativePathname);
            if ($pathInfo['dirname'] == '.') {
                $key = $pathInfo['filename'];
            } else {
                $key = str_replace('/', '.', $pathInfo['dirname']) . '.' . $pathInfo['filename'];
            }

            $this->set($key, require $path . '/' . $relativePathname);
        }
    }
}