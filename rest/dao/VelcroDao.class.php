<?php

require_once 'BaseDao.class.php';

class VelcroDao extends BaseDao{
  //GET ALL
  public function get_all_velcro(){
    return $this->query("SELECT * FROM velcro");
  }
  //GET BY NAME
  public function get_velcro_by_name($name){
    return $this->queryUnique("SELECT * FROM velcro WHERE name=:name",["name"=>$name]);
  }
  //ADD TO DATABASE
  public function add($name, $color, $type, $length, $available){
    $stmt = $this->conn->prepare("INSERT INTO velcro (name, color, type, length, available) VALUES (:name, :color, :type, :length, :available)");
    $stmt->execute(['name' => $name, 'color' => $color,'type' => $type, 'length'=>$length, 'available' => $available]);
  }
  //DELETE (kinda useless)
  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM velcro WHERE id=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }
  //UPDATE
  public function update($id, $name, $color, $type, $length, $available){
    $stmt = $this->conn->prepare("UPDATE velcro SET name=:name, color=:color, type=:type, length=:length, available=:available WHERE id=:id");
    $stmt->execute(['id' => $id, 'name' => $name, 'color' => $color, 'type'=>$type, 'length'=>$length, 'available'=>$available]);
  }
}

 ?>
