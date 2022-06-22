<?php

require_once __DIR__.'/BaseDao.class.php';

class BrandsDao extends BaseDao{

  //CONSTRUCTOR
  public function __construct(){
    parent::__construct("brands");
  }

  public function get_material_by_brand_id($brand_id){
    return $this->query("SELECT * FROM material WHERE brand_id = :brand_id", ['brand_id' => $brand_id]);
  }
}

?>
