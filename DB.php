<?php

class DB {

    private static $instance;
    private $connection;

    // private $db_name = "14116974d"; // db name
    // private $db_user = "14116974d";// db user
    // private $db_pasword = "migdzart"; // db password
    // private $db_server = "mysql.comp.polyu.edu.hk"; // db server

    private $db_name = "14116974d"; // db name
    private $db_user = "root";// db user
    private $db_pasword = "root"; // db password
    private $db_server = "127.0.0.1"; // db server

    private function __construct(){
        try {
    		$this->connection = new PDO("mysql:host=".$this->db_server.";dbname=".$this->db_name, $this->db_user, $this->db_pasword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    		$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
    		echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function prepare($sql, $array_values){
        $statement = $this->connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	    $statement->execute($array_values);
        return $statement;
    }

    public function query($sql){
        $statement = $this->connectin->prepare($sql);
        $statement->execute();
        return $statement;
    }

    public function lastInsertId(){
        return $this->connection->lastInsertId();
    }
}

?>
