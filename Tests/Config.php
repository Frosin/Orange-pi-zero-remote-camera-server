<?php

namespace Tests;

class Config
{
    private $config;

    public function create()
    {
        $this->config = new \Classes\Config("test_config.dat");
        echo "create success\n";
    }

    public function get()
    {
        if ($this->config->get("test")) {
            echo "get success\n";
        }
    }

    public function set()
    {
        $this->config->set("test", "123test");
        if ($this->config->get("test")) {
            echo "set success\n";
        }
    }

    public function runTests()
    {
        // set in init.php - (new Tests\Config())->runTests();
        try {
            $this->create();
            //$this->get();
            $this->set();
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }

}