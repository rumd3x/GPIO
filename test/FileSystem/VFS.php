<?php

require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/FileSystem/FileSystemInterface.php');

class VFS implements FileSystemInterface
{
    private $vfs = [];

    public function open($path, $mode) {}

    public function getContents($path)
    {
        return $this->vfs[$path];
    }

    public function putContents($path, $buffer)
    {
        $this->vfs[$path] = $buffer;
    }
}
