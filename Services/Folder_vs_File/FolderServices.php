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
    *
    * @usage remove empty folder and folder with files inside.
    *    This function can't remove folder if one have a lot of subfolder that have more files inside it
    *
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

    /*
    * @remove all files and subfolder inside it
    * @param string $path : file path
    * @param string $permission : permission
    */
    public function rrmdir($path, $root = 0)
    {
        if (is_dir($path)) {
            $objects = scandir($path);
            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (filetype($path . '/' . $object) == 'dir') {
                        $this->rrmdir($path . '/' . $object);
                    } else {
                        unlink($path . '/' . $object);
                    }
                }
            }

            reset($objects);
            if (!$root) {
                rmdir($path);
            }
        }
    }
}