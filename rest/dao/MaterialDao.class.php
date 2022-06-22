<?php

require_once __DIR__.'/BaseDao.class.php';

class MaterialDao extends BaseDao{

  //CONSTRUCTOR
  public function __construct(){
    parent::__construct("material");
  }

  public function get_by_color_route($id){
    $stmt = $this->conn->prepare("SELECT material.id, material.brand_id, brands.name as brand_name, material.type_id,types.name as type_name, material.length,      material.available,material.color_id, colors.name as color_name
      FROM material
      LEFT JOIN colors
      ON material.color_id = colors.id
      LEFT JOIN types ON material.type_id=types.id
      LEFT JOIN brands on material.brand_id=brands.id
      WHERE material.id = :id;");

    $stmt->execute(['id' => $id]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return reset($result);
  }

  public function get_all_updated(){
    $stmt = $this->conn->prepare("SELECT material.id, brands.name as brand_name, types.name as type_name, material.length, material.available, colors.name as color_name
      FROM material
      LEFT JOIN colors
      ON material.color_id = colors.id
      LEFT JOIN types ON material.type_id=types.id
      LEFT JOIN brands ON material.brand_id=brands.id
      ORDER BY type_name ASC;");

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

  //as color_name, colors.id
  //SELECT * FROM ".$this->table_name." WHERE id = :id
?>
