<?php
namespace Classes;

class Server
{
    const MAX_INDEX = 10;
    const LIFE_TIME = 700;
    private $memory;

    public function __construct() {
        $this->memory = new \Classes\Memory();
    }

    public function setFile() {
        if (isset($_FILES['file']['tmp_name'])) {
            $fileData = file_get_contents($_FILES['file']['tmp_name']);
            $this->addToStorage($fileData);
        } else {
            throw new \Exception("Not found uploaded file");
        }
    }


    public function getFile() {
        $fileData = $this->memory->get('photo');
        echo $fileData['data'][static::MAX_INDEX];
    }


    public function getAllFiles() {
        $fileData = $this->memory->get('photo');
        echo json_encode($fileData['data']);
    }

    private function addToStorage($fileData) {
        $currentData = $this->memory->get('photo')['data'];
        array_push($currentData,  base64_encode($fileData));
        if (count($currentData) > static::MAX_INDEX) {
            array_shift($currentData);
        }
        $this->memory->add('photo', array(
            'data' => $currentData
        ), static::LIFE_TIME);
    }

}