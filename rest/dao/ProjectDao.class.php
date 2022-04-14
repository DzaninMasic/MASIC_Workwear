<?php

require_once __DIR__.'/BaseDao.class.php';

class ProjectDao extends BaseDao{

  //CONSTRUCTOR
  public function __construct(){
    parent::__construct("material");
  }

  public function get_by_color_route($id){
    $stmt = $this->conn->prepare("SELECT material.id, material.name, material.length, material.available, colors.name as color_name
      FROM material
      LEFT JOIN colors
      ON material.color_id = colors.id
      WHERE material.id = :id;");

    $stmt->execute(['id' => $id]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return reset($result);
  }
}

  //as color_name, colors.id
  //SELECT * FROM ".$this->table_name." WHERE id = :id
?>
