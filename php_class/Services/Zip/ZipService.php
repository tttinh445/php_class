<?php

class ZipService
{
    protected $config = [
        'path' => __DIR__,
    ];


    public function create($params)
    {
        // zip files
        $zipArchive = new \ZipArchive();
        $sZipName = $this->config['path'] . '/file/test' . '.zip';

        $zipArchive->open($sZipName, \ZipArchive::CREATE);

        $filePath = $this->config['path'] . '/file';
        if (file_exists($filePath)) {
            $fileContent = file_get_contents($filePath . '/test.txt');
            $zipArchive->addFromString('test.txt', $fileContent);
        }
        $zipArchive->close();

        return $sZipName;
    }
}