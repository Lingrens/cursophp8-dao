<?php

class Sql extends PDO {

    private $conn;

    public function __construct() {

        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp8", "root", "lipe17mila12");

    }

    private function setParams($statements, array $parameters){
        foreach ($parameters as $key => $value) {
            $this->setParam($statements, $key, $value);
        }
    }
    
    private function setParam($statements, $Key, $Value){
        $statements->bindParam(":{$Key}", $Value);
    }

    public function execQuery($rawQuery, $params = array()) {

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;

    }

    public function select($rawQuery, $params = array()):array
    {

        $stmt = $this->execQuery($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}

?>