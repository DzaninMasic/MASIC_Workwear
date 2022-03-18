
<?php

class ProjectDao{

  private $conn;

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
  //GET ALL
  public function get_all(){
    $stmt = $this->conn->prepare("SELECT * FROM material");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  //ADD TO DATABASE
  public function add($name, $color, $length, $available){
    $stmt = $this->conn->prepare("INSERT INTO material (name, color, length, available) VALUES (:name, :color, :length, :available)");
    $stmt->execute(['name' => $name, 'color' => $color,'length' => $length,'available' => $available]);
  }
  //DELETE (kinda useless)
  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM material WHERE id=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }
  //UPDATE
  public function update($id, $name, $color, $length, $available){
    $stmt = $this->conn->prepare("UPDATE material SET name=:name, color=:color, length=:length, available=:available WHERE id=:id");
    $stmt->execute(['id' => $id, 'name' => $name, 'color' => $color, 'length'=>$length, 'available'=>$available]);
  }
}

?>
