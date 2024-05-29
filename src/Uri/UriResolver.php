<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Uri;

use Fschmtt\Keycloak\Exception\FilesystemException;

class UriResolver
{
    /**
     * @throws FilesystemException
     */
    public function resolve(string $uri): string
    {
        if (is_dir($uri)) {
            $this->resolveDirectory($uri);
        }

        if (!file_exists($uri)) {
            throw new FilesystemException('The file does not exist');
        }

        // If file is zip
        if (pathinfo($uri, PATHINFO_EXTENSION) === 'zip') {
            $this->resolveZip($uri);
        }

        $content = file_get_contents($uri);

        if ($content === false) {
            throw new FilesystemException('Could not read the file');
        }

        return $content;
    }

    private function resolveDirectory(string $uri): string
    {
        throw new FilesystemException('The URI is a directory, not a file');
        //        $files = scandir($uri);
        //        $content = '';
        //        foreach ($files as $file) {
        //            if ($file === '.' || $file === '..') {
        //                continue;
        //            }
        //            $content .= file_get_contents($uri . '/' . $file);
        //        }
        //        return $content;
    }

    private function resolveZip(string $uri): string
    {
        throw new FilesystemException('The file is a zip file');
        //        $zip = new ZipArchive();
        //        $zip->open($uri);
        //        $content = '';
        //        for ($i = 0; $i < $zip->numFiles; $i++) {
        //            $content .= $zip->getFromIndex($i);
        //        }
        //        $zip->close();
        //        return $content;
    }
}
