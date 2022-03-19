<?php

class BaseDao{

  protected $conn;

  //CONSTRUCTOR
  public function __construct(){
  $servername = "sql11.freemysqlhosting.net";
  $username = "sql11479687";
  $password = "vA323dsrUN";
  $schema = "sql11479687";
  $this->conn = new PDO("mysql:host=$servername;port=3306;dbname=$schema", $username, $password);
  // set the PDO error mode to exception
  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
  //TEST
  public function query($query){
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function queryUnique($query, $params){
    $results= $this->conn->prepare($query);
    $results->execute($params);
    return $results->fetchAll(PDO::FETCH_ASSOC);
  }
}

?>
