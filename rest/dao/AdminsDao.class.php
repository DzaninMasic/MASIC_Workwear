
<?php

class AdminsDao{

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
    $stmt = $this->conn->prepare("SELECT * FROM admins");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  //ADD TO DATABASE
  public function add($name, $email, $password){
    $stmt = $this->conn->prepare("INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute(['name' => $name, 'email' => $email,'password' => $password]);
  }
  //DELETE (kinda useless)
  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM admins WHERE id=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }
  //UPDATE
  public function update($id, $name, $color, $length, $available){
    $stmt = $this->conn->prepare("UPDATE admins SET name=:name, email=:email, password=:password WHERE id=:id");
    $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email, 'password'=>$password]);
  }
}

?>
