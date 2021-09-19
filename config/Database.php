<?php

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    class Database {
        // DB Params
        private $host;
        private $db_name;
        private $username;
        private $password;
        private $conn;

        // Contructor
        function __construct() {
            $this->host = $_ENV['HOST'];
            $this->db_name = $_ENV['DBNAME'];
            $this->username = $_ENV['UNAME'];
            $this->password = $_ENV['PASS'];
        }

        // DB Connect
        public function connect() {
            $this->conn = null;

            try { 
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }

?>