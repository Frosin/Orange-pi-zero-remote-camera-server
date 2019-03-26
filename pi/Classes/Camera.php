<?php
namespace Classes;

class Camera
{

    private $resolution;

    public function __construct($resolution = "640x480", $options = array())
    {
        $this->resolution = $resolution; 
    }

    public function makeShot() 
    {
        $fileName = 'shot.jpg';
        shell_exec("fswebcam -d /dev/video0 -r " . $this->resolution . __DIR__ . "/$fileName");

        if (!file_exists($fileName)) {
            throw new \Exception("Error in making photo. File `$fileName` not found");
        }

        return $fileName;
    }
}