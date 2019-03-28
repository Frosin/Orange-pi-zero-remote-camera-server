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
        $fileName = realpath(__DIR__ . "/../") . '/shot.jpg';
        shell_exec("fswebcam -d /dev/video0 -S 3 -r " . $this->resolution . " $fileName");
        //shell_exec('php ~/Рабочий\ стол/orange_pi_camera/makephoto.php');

        if (!file_exists($fileName)) {
            throw new \Exception("Error in making photo. File `$fileName` not found");
        }
        
        return $fileName;
    }
}