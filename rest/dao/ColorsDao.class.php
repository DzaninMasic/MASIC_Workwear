<?php

require_once __DIR__.'/BaseDao.class.php';

class ColorsDao extends BaseDao{

  //CONSTRUCTOR
  public function __construct(){
    parent::__construct("colors");
  }

  public function get_material_by_color_id($color_id){
    return $this->query("SELECT * FROM material WHERE color_id = :color_id", ['color_id' => $color_id]);
  }
}

?>
