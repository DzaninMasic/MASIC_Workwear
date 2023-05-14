<?php

require_once __DIR__.'/BaseDao.class.php';

class MaterialDao extends BaseDao{
  private static $instance = null;

  //CONSTRUCTOR
  private function __construct(){
    parent::__construct("material");
  }

  public static function getInstance() {
    if (!isset(self::$instance)) {
      self::$instance = new MaterialDao();
    }
    return self::$instance;
  }

  public function get_by_color_route($id){
    $stmt = $this->conn->prepare("SELECT *
      FROM material
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
      ORDER BY material.id DESC;");

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_searched($name){
    $name=strtolower($name);
    $query="SELECT material.id, brands.name as brand_name, types.name as type_name, material.length, material.available, colors.name as color_name
      FROM material
      LEFT JOIN colors
      ON material.color_id = colors.id
      LEFT JOIN types ON material.type_id=types.id
      LEFT JOIN brands ON material.brand_id=brands.id
      WHERE LOWER(brands.name) LIKE '%".$name."%' OR LOWER(types.name) LIKE '%".$name."%' ORDER BY type_name ASC;";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function filter_search($type, $order){
    $query="SELECT material.id, brands.name as brand_name, types.name as type_name, material.length, material.available, colors.name as color_name
        FROM material
        LEFT JOIN colors
        ON material.color_id = colors.id
        LEFT JOIN types ON material.type_id=types.id
        LEFT JOIN brands ON material.brand_id=brands.id
        ORDER BY ".$type." ".$order.";";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function color_length(){
    $query="SELECT c.name as color_name, SUM(m.length) as sum_length
        FROM material m
        JOIN colors c ON c.id = m.color_id
        GROUP BY m.color_id;";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

  //as color_name, colors.id
  //SELECT * FROM ".$this->table_name." WHERE id = :id
?>
