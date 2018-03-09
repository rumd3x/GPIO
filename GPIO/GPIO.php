<?php

require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'GPIOInterface.php');
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Pin/InputPin.php');
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Pin/OutputPin.php');
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'FileSystem/FileSystem.php');
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'FileSystem/FileSystemInterface.php');
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Interrupt/InterruptWatcher.php');

final class GPIO implements GPIOInterface
{
    private $fileSystem;
    private $streamSelect;

    /**
     * Constructor.
     * 
     * @param FileSystemInterface $fileSystem Optional file system object to use
     * @param callable $streamSelect Optional sream select callable
     */
    public function __construct(FileSystemInterface $fileSystem = null, callable $streamSelect = null)
    {
        $this->fileSystem = $fileSystem ?: new FileSystem();
        $this->streamSelect = $streamSelect ?: 'stream_select';
    }

    /**
     * {@inheritdoc}
     */
    public function getInputPin($number)
    {
        return new InputPin($this->fileSystem, $number);
    }

    /**
     * {@inheritdoc}
     */
    public function getOutputPin($number)
    {
        return new OutputPin($this->fileSystem, $number);
    }

    /**
     * {@inheritdoc}
     */
    public function createWatcher()
    {
        return new InterruptWatcher($this->fileSystem, $this->streamSelect);
    }
}
