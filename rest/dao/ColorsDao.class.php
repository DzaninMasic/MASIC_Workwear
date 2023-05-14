<?php

require_once __DIR__.'/BaseDao.class.php';

class ColorsDao extends BaseDao{
  private static $instance = null;

  //CONSTRUCTOR
  private function __construct(){
    parent::__construct("colors");
  }
  
  public static function getInstance() {
    if (!isset(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function add($entity){
    return $this->query("INSERT INTO colors (name) VALUES (:color)",['color'=>$entity['color-name']]);
  }

  public function get_material_by_color_id($color_id){
    return $this->query("SELECT * FROM material WHERE color_id = :color_id", ['color_id' => $color_id]);
  }
}

?>
