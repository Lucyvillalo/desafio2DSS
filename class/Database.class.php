<?php
class Database {
    private $host;
    private $user;
    private $pass;
    private $data;
    public $db;

   public function __construct($host, $user, $pass, $data) {
    $this->host = $host;
    $this->user = $user;   // ✅ CORREGIDO
    $this->pass = $pass;   // ✅ CORREGIDO
    $this->data = $data;
    $this->connect();
}

    private function connect() {
        $this->db = new mysqli($this->host, $this->user, $this->pass, $this->data);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }
}

?>