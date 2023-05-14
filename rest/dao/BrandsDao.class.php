<?php

require_once __DIR__.'/BaseDao.class.php';

class BrandsDao extends BaseDao{
  private static $instance = null;

  //CONSTRUCTOR
  private function __construct(){
    parent::__construct("brands");
  }

  public static function getInstance() {
    if (!isset(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function get_material_by_brand_id($brand_id){
    return $this->query("SELECT * FROM material WHERE brand_id = :brand_id", ['brand_id' => $brand_id]);
  }
}

?>
