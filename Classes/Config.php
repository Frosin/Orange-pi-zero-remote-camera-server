<?php
namespace Classes;

class Config 
{
    private $fileName;
    private $config = false;

    public function __construct($fileName)
    {
        $this->fileName = realpath(__DIR__ . "/../") . "/" . $fileName;
        if (!file_exists($this->fileName)) {
            fopen($this->fileName, "w");
        }
    }

    private function loadConfig()
    {
        $fileData = file_get_contents($this->fileName);

        if (!$this->config) {
            $this->config = unserialize($fileData);
        } 
        
        if (!$this->config) {
            if (strlen($fileData) === 0)  {
                $this->config = array();
            } else {
                throw new \Exception("Unserialize config file error");
            }
            
        }
        
        return $this->config;
    }

    public function get($optionName)
    {
        $fileData = $this->loadConfig();
        if (isset($fileData[$optionName])) {
            return $fileData[$optionName];
        } else {
            $baseName = basename($this->fileName);
            throw new \Exception("Not found option `$optionName` in config file `$baseName`");
        }
    }

    public function set($optionName, $value)
    {
        $fileData = $this->loadConfig();
        $fileData[$optionName] = $value;
        $this->config = $fileData;
        file_put_contents($this->fileName, serialize($fileData));
    }
}
