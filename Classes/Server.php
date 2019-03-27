<?php
namespace Classes;

class Server
{
    private $memory;

    public function __construct()
    {
        $this->memory = new \Classes\Memory();
    }

    public function setFile()
    {
        if (isset($_FILES['file']['tmp_name'])) {
            $fileData = file_get_contents($_FILES['file']['tmp_name']);
            $this->memory->add('photo', array(
                'time' => time(),
                'date' => date("d.m.Y H:i:s"),
                'data' => base64_encode($fileData)
            ), 60);
        } else {
            throw new \Exception("Not found uploaded file");
        }
    }


    public function getFile()
    {
        $fileData = $this->memory->get('photo');
        echo $fileData['data'];
    }

}