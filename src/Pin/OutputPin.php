<?php

require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Pin.php');
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'OutputPinInterface.php');
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '../FileSystem/FileSystemInterface.php');

final class OutputPin extends Pin implements OutputPinInterface
{
    /**
     * Constructor.
     * 
     * @param FileSystemInterface $fileSystem An object that provides file system access
     * @param int                 $number     The number of the pin
     */
    public function __construct(FileSystemInterface $fileSystem, $number)
    {
        parent::__construct($fileSystem, $number);

        $this->setDirection(self::DIRECTION_OUT);
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $valueFile = $this->getPinFile(self::GPIO_PIN_FILE_VALUE);
        $this->fileSystem->putContents($valueFile, $value);
    }
}
