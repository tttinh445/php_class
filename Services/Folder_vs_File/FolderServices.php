<?php

class FolderService
{
    /*
    * @usage create folder
    * @param string $path : file path
    * @param string $permission : permission
    */
    public function create($path, $permission = '0775')
    {
        if (!file_exists($path)) {
            $oldMask = umask(0);
            mkdir($path, $permission);
            umask($oldMask);
        }
    }


    /*
    * rmdir function only remove empty folder.
    * @usage remove empty folder and folder with files inside.
        This function can't remove folder if one have a lot of subfolder that have more files inside it
    * @param string $path : file path
    * @param string $permission : permission
    */
    public function remove($path)
    {
        if (is_dir($path)) {
           $path = rtrim($path, '/');
            array_map('unlink', glob($path . "/*.*"));
            rmdir($path);
        }
    }
}