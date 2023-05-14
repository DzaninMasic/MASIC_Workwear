<?php

require_once __DIR__.'/BaseDao.class.php';

class TypesDao extends BaseDao{
  private static $instance = null;

  //CONSTRUCTOR
  private function __construct(){
    parent::__construct("types");
  }

  public static function getInstance() {
    if (!isset(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function get_material_by_type_id($type_id){
    return $this->query("SELECT * FROM material WHERE type_id = :type_id", ['type_id' => $type_id]);
  }
}

?>
