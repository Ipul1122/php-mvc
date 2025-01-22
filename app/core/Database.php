<?php

class Database {
    private $host = DB_HOST; //localhost
    private $user = DB_USER; //root
    private $pass = DB_PASS; //'' (empty)
    private $db_name = DB_NAME; //phpmvc

    private $dbh; //database handler
    private $stmt; //statement

    public function __construct(){
        //data source name
        $dsn = 'mysql:host= '. $this->host .';dbname='. $this->db_name;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        
        try {
            $this->dbh = new PDO("mysql:host=$this->host;dbname=" . $this->db_name, $this->user, $this->pass, $option);
            // set the PDO error mode to exception
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e) {
            die($e->getMessage());
        }

    }

    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null) {
        if (is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    
    public function execute(){
        $this->stmt->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}
