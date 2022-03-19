<?php

require_once 'BaseDao.class.php';

class ButtonsDao extends BaseDao{
  //GET ALL
  public function get_all_buttons(){
    return $this->query("SELECT * FROM buttons");
  }
  //GET BY NAME
  public function get_button_by_name($name){
    return $this->queryUnique("SELECT * FROM buttons WHERE name=:name",["name"=>$name]);
  }
  //ADD TO DATABASE
  public function add($name, $amount, $size, $type, $available){
    $stmt = $this->conn->prepare("INSERT INTO buttons (name, amount, size, type, available) VALUES (:name, :amount, :size, :type, :available)");
    $stmt->execute(['name' => $name, 'amount' => $amount,'size' => $size, 'type'=>$type, 'available' => $available]);
  }
  //DELETE (kinda useless)
  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM buttons WHERE id=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }
  //UPDATE
  public function update($id, $name, $amount, $size, $type, $available){
    $stmt = $this->conn->prepare("UPDATE buttons SET name=:name, amount=:amount, size=:size, type=:type, available=:available WHERE id=:id");
    $stmt->execute(['id' => $id, 'name' => $name, 'amount' => $amount, 'size'=>$size, 'type'=>$type, 'available'=>$available]);
  }
}

 ?>
