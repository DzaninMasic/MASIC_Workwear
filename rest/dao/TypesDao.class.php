<?php

require_once __DIR__.'/BaseDao.class.php';

class TypesDao extends BaseDao{

  //CONSTRUCTOR
  public function __construct(){
    parent::__construct("types");
  }

  public function get_material_by_type_id($type_id){
    return $this->query("SELECT * FROM material WHERE type_id = :type_id", ['type_id' => $type_id]);
  }
}

?>
