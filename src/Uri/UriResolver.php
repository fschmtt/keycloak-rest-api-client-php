<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Uri;

use Fschmtt\Keycloak\Exception\FilesystemException;
use Fschmtt\Keycloak\Exception\JsonDecodeException;
use Fschmtt\Keycloak\Json\JsonDecoder;
use ZipArchive;

class UriResolver
{
    /**
     * @param string $uri
     * @return array
     * @throws FilesystemException
     * @throws JsonDecodeException
     */
    public function resolve(string $uri): array
    {
        if (is_dir($uri)) {
            return $this->mergeFiles($this->resolveDirectory($uri));
        }

        if (!file_exists($uri)) {
            throw new FilesystemException('The file does not exist');
        }

        if (pathinfo($uri, PATHINFO_EXTENSION) === 'zip') {
            return $this->mergeFiles($this->resolveZip($uri));
        }

        if (pathinfo($uri, PATHINFO_EXTENSION) !== 'json') {
            throw new FilesystemException('The file is not a JSON file');
        }

        $content = file_get_contents($uri);

        if ($content === false) {
            throw new FilesystemException('Unable to read the file');
        }

        return (new JsonDecoder())->decode($content);
    }

    /**
     * @param string $uri
     * @return string[]
     * @throws FilesystemException
     */
    private function resolveDirectory(string $uri): array
    {
        $files = scandir($uri);
        if ($files === false) {
            throw new FilesystemException('Unable to read the directory');
        }

        $fileContents = [];
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            if (is_dir($uri . '/' . $file)) {
                $fileContents = $this->array_merge_recursive_distinct($fileContents, $this->resolveDirectory($uri . '/' . $file));
                continue;
            }
            if (!str_ends_with($file, '.json') && !str_ends_with($file, '.zip')) {
                continue;
            }
            if (str_ends_with($file, '.zip')) {
                $fileContents = $this->array_merge_recursive_distinct($fileContents, $this->resolveZip($uri . '/' . $file));
                continue;
            }
            $fileContents[] = file_get_contents($uri . '/' . $file);
        }

        return $fileContents;
    }

    /**
     * @param string $uri
     * @return string[]
     * @throws FilesystemException
     */
    private function resolveZip(string $uri): array
    {
        $zip = new ZipArchive();
        $result = $zip->open($uri);
        if ($result !== true) {
            throw new FilesystemException('Unable to open the ZIP file');
        }

        $fileContents = [];
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $filename = $zip->getNameIndex($i);
            if ($filename !== false && str_ends_with($filename, '.json')) {
                $fileContents[] = $zip->getFromIndex($i) ?: '';
            }
        }

        $zip->close();

        return $fileContents;
    }

    /**
     * @param string[] $fileContents
     * @return array
     * @throws JsonDecodeException
     */
    private function mergeFiles(array $fileContents): array
    {
        $fullJson = [];
        foreach ($fileContents as $content) {
            $decodedContent = (new JsonDecoder())->decode($content);
            $key = array_search($decodedContent['realm'], array_column($fullJson, 'realm'), true);
            if ($key !== false) {
                $fullJson[$key] = $this->array_merge_recursive_distinct($fullJson[$key], $decodedContent);
            } else {
                $fullJson[] = $decodedContent;
            }
        }

        if (empty($fullJson)) {
            throw new JsonDecodeException('No JSON files found in the directory');
        }

        return $fullJson;
    }

    /**
     * @param array $array1
     * @param array $array2
     * @return array
     */
    private function array_merge_recursive_distinct(array $array1, array $array2): array
    {
        foreach ($array2 as $key => $value) {
            if (is_array($value)) {
                if (isset($array1[$key]) && is_array($array1[$key])) {
                    // Check if the value is a sequential array (list)
                    if (array_keys($value) === range(0, count($value) - 1)) {
                        // Merge arrays by appending
                        $array1[$key] = array_merge($array1[$key], $value);
                    } else {
                        // Merge associative arrays recursively
                        $array1[$key] = $this->array_merge_recursive_distinct($array1[$key], $value);
                    }
                } else {
                    $array1[$key] = $value;
                }
            } else {
                $array1[$key] = $value;
            }
        }
        return $array1;
    }
}
