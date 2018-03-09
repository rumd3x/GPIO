<?php


require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Pin.php');
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'InputPinInterface.php');
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '../FileSystem/FileSystemInterface.php');

final class InputPin extends Pin implements InputPinInterface
{
    const GPIO_PIN_FILE_EDGE = 'edge';

    /**
     * Constructor.
     * 
     * @param FileSystemInterface $fileSystem An object that provides file system access
     * @param int                 $number     The number of the pin
     */
    public function __construct(FileSystemInterface $fileSystem, $number)
    {
        parent::__construct($fileSystem, $number);

        $this->setDirection(self::DIRECTION_IN);
    }

    /**
     * {@inheritdoc}
     */
    public function getEdge()
    {
        $edgeFile = $this->getPinFile(self::GPIO_PIN_FILE_EDGE);
        return $this->fileSystem->getContents($edgeFile);
    }

    /**
     * {@inheritdoc}
     */
    public function setEdge($edge)
    {
        $edgeFile = $this->getPinFile(self::GPIO_PIN_FILE_EDGE);
        $this->fileSystem->putContents($edgeFile, $edge);
    }
}
