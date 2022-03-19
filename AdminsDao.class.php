<?php

require_once 'BaseDao.class.php';

class AdminsDao extends BaseDao{
  //GET ALL
  public function get_all_admins(){
    return $this->query("SELECT * FROM admins");
  }
  //GET BY NAME
  public function get_admin_by_name($name){
    return $this->queryUnique("SELECT * FROM admins WHERE name=:name",["name"=>$name]);
  }
  //ADD TO DATABASE
  public function add($name, $email, $password){
    $stmt = $this->conn->prepare("INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute(['name' => $name, 'email' => $email, 'password'=>$password]);
  }
  //DELETE (kinda useless)
  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM admins WHERE id=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }
  //UPDATE
  public function update($id, $name, $email, $password){
    $stmt = $this->conn->prepare("UPDATE admins SET name=:name, email=:email, password=:password WHERE id=:id");
    $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email, 'password'=>$password]);
  }
}

 ?>
