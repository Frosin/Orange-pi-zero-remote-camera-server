<?php

namespace Tests;

class Memory
{

    private $memory;

    public function __construct()
    {
        $this->memory = new \Classes\Memory();
    }

    public function add()
    {
        $value = uniqid();
        $result = $this->memory->add('test', $value, 60);
        if ($this->memory->get('test') === $value) {
            echo "get success\n";
            echo "add success\n";
        }
    }

    public function addStrict()
    {
        $value = uniqid();
        $result = $this->memory->addStrict('test', $value, 60);

        if ($this->memory->get('test') === $value) {
            echo "get success\n";
            echo "addStrict success\n";
        }
    }

    public function set()
    {
        $value = uniqid();
        $this->memory->set("test", $value);
        if ($this->memory->get('test') === $value) {
            echo "set success\n";
        }
    }

    public function runTests()
    {
        // set in init.php - (new Tests\Memory())->runTests();
        try {
            $this->add();
            //$this->addStrict();
            $this->set();
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }


}