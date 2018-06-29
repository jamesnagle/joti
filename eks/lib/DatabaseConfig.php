<?php
namespace Eks;

class DatabaseConfig
{
    public $environment = null;
    private $credentials = [];

    function __construct($connection_array)
    {
        if ($_SERVER['HTTP_HOST'] === $connection_array['local']['domain'])  {
            $this->environment = 'local';
            $this->credentials = $connection_array['local'];
        } else if ($_SERVER['HTTP_HOST'] === $connection_array['production']['domain']) {
            $this->environment = 'production';
            $this->credentials = $connection_array['production'];
        } else {
            throw new \Exception("Unable to set 'local' or 'production' DB environments.");
        }
    }
    protected function testConnection() {
        $mysqli = new \mysqli(
            $this->credentials['host'], 
            $this->credentials['username'], 
            $this->credentials['password'], 
            $this->credentials['database']
        );

        if ($mysqli->connect_errno) {
            throw new \Exception("Unable to connect to mySQL database. {$mysqli->connect_error}");
        }
        $mysqli->close();

        return $this;
    }
    protected function getCredentials() {
        return $this->credentials;
    }
    public function load() {
        return $this->testConnection()->getCredentials();
    }
}