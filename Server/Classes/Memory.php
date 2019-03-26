<?php
namespace Classes;

class Memory
{

    private $memcache;
    private $connected = false;


    public function __construct() 
    {

        $this->memcache = new \Memcache;

        if (!$this->connect()) {
            $this->createServer();
            $this->connect();
        }

        if (!$this->connected) {
            return false;
            throw new \Exception("NO MONEY - NO MEMCACHE!");
        }

        return $this;
    }

    private function createServer()
    {
        $this->memcache->addServer('localhost', 11211);
    }


    private function connect()
    {
        $this->connected = $this->memcache->connect('localhost', 11211);
        return $this->connected;
    }

    public function get($obj) {
        $result = $this->memcache->get($obj);
        if (!$result) {
            throw new \Exception("Object = `$obj` not found or empty");
        }
        return $result;
    }


    public function set($obj, $value) {
        $result = $this->memcache->set($obj, $value);
        if (!$result) {
            throw new \Exception("Can't set new value = `$value` to object = `$obj`");
        } else {
            return $this;
        }
    }

    public function add($obj, $value, $livetime) {
        $result = $this->memcache->add($obj, $value, false, $livetime);

        if (!$result) {
            throw new \Exception("This object `$obj` already exists or it was adding error");
        } else {
            return $this;
        }
    }


}