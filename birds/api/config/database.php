<?php
class Database
{
    private $host;
    private $user;
    private $pass;
    private $database;
    private $port;
    private $conn; // Add this line

    function __construct($host, $user, $pass, $database, $port)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;
        $this->port = $port;
    }

    public function connect()
    {
        // Implement bd connection
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->database, $this->port);
        if($this->conn->connect_error){
            die("Connection failed: " . $this->conn->connect_error);
        }else{
            echo "Connected successfully";
        }
        return $this->conn;
    }

    function disconnect(){
        $this->conn->close(); 
    }
}

$conn = new Database("localhost", "root", "", "birds", "3306");
$dbConn = $conn->connect();
$conn->disconnect(); 
?>