<?php

class connections {

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db = '';


    public function connectDB() {
        $conn = new mysqli($this->host, $this->user,$this->pass,$this->db);

        if($conn->connect_error){
            die("Error failed to connect ". $conn->connect_error);
        }else {
            return $conn;
        }
    }


}

?>