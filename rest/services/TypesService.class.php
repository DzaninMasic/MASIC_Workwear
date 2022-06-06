<?php
  require_once __DIR__.'/BaseService.class.php';
  require_once __DIR__.'/../dao/TypesDao.class.php';

  class TypesService extends BaseService{

    public function __construct(){
      parent::__construct(new TypesDao());
    }
    
    public function get_material_by_type_id($type_id){
      return $this->dao->get_material_by_type_id($type_id);
    }
  }
?>
