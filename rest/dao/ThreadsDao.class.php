<?php

require_once 'BaseDao.class.php';

class ThreadsDao extends BaseDao{
  //GET ALL
  public function get_all_threads(){
    return $this->query("SELECT * FROM threads");
  }
  //GET BY NAME
  public function get_thread_by_name($name){
    return $this->queryUnique("SELECT * FROM threads WHERE name=:name",["name"=>$name]);
  }
  //ADD TO DATABASE
  public function add($code, $name, $color, $length, $amount, $width, $available){
    $stmt = $this->conn->prepare("INSERT INTO threads (code, name, color, length, amount, width, available) VALUES (:code, :name, :color, :length, :amount, :width, :available)");
    $stmt->execute(['code'=>$code, 'name' => $name, 'color' => $color,'length' => $length, 'amount'=>$amount, 'width'=>$width, 'available' => $available]);
  }
  //DELETE (kinda useless)
  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM threads WHERE id=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }
  //UPDATE
  public function update($id, $code, $name, $color, $length, $amount, $width, $available){
    $stmt = $this->conn->prepare("UPDATE threads SET code=:code, name=:name, color=:color, length=:length, amount=:amount, width=:width, available=:available WHERE id=:id");
    $stmt->execute(['id' => $id, 'code'=>$code, 'name' => $name, 'color' => $color,'length' => $length, 'amount'=>$amount, 'width'=>$width, 'available' => $available]);
  }
}

 ?>
