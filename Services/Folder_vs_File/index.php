<?php
require_once './FolderServices.php';

$folder = new FolderService();
/* create folder */
// $folder->create('test');

/* remove folder */
$folder->remove('test');