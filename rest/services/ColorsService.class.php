<?php
  require_once __DIR__.'/BaseService.class.php';
  require_once __DIR__.'/../dao/ColorsDao.class.php';

  class ColorsService extends BaseService{

    public function __construct(){
      parent::__construct(new ColorsDao());
    }
    
    public function get_material_by_color_id($color_id){
      return $this->dao->get_material_by_color_id($color_id);
    }
  }
?>
