<?php

require_once 'BaseDao.class.php';

class ZippersDao extends BaseDao{
  //GET ALL
  public function get_all_zippers(){
    return $this->query("SELECT * FROM zippers");
  }
  //GET BY NAME
  public function get_zipper_by_name($name){
    return $this->queryUnique("SELECT * FROM zippers WHERE name=:name",["name"=>$name]);
  }
  //ADD TO DATABASE
  public function add($name, $type, $amount, $size, $available, $color){
    $stmt = $this->conn->prepare("INSERT INTO threads (name, type, amount, size, available, color) VALUES (:name, :type, :amount, :size, :available, :color)");
    $stmt->execute(['name' => $name, 'type' => $type, 'amount'=>$amount, 'size' => $size, 'available' => $available, 'color' => $color]);
  }
  //DELETE (kinda useless)
  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM zippers WHERE id=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }
  //UPDATE
  public function update($id, $name, $type, $amount, $size, $available, $color){
    $stmt = $this->conn->prepare("UPDATE zippers SET name=:name, type=:type, amount=:amount, size=:size, available=:available, color=:color WHERE id=:id");
    $stmt->execute(['id' => $id, 'name' => $name, 'type' => $type, 'amount'=>$amount, 'size'=>$size, 'available'=>$available, 'color'=>$color]);
  }
}

 ?>
