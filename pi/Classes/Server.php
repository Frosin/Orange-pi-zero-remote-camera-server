<?php
namespace Classes;

class Server
{
    private $serverUrl;

    public function __construct($serverUrl)
    {
        $this->serverUrl = $serverUrl;
    }

    public function sendToServer($fileName)
    {
        if (!file_exists($fileName)) {
            throw new \Exception("Can't send file to server. File `$fileName` not found");
        }

        $post = array (
            'file' => curl_file_create($fileName, '', '')
        );
        
        $ch = curl_init($this->servevrUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $msg = curl_exec ($ch);
        $info = curl_getinfo($ch);
        
        if ($info['http_code'] != 200){
            $returnMessage = json_decode($msg, 1);
            throw new \Exception("Error in sending to server: " . $returnMessage);
        }
        curl_close($ch);
        return true;
    }
}