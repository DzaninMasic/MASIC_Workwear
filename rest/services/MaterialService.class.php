<?php
  require_once __DIR__.'/BaseService.class.php';
  require_once __DIR__.'/../dao/ProjectDao.class.php';

  class MaterialService extends BaseService{

    public function __construct(){
      parent::__construct(new ProjectDao());
    }

    public function get_by_color_route($id){
      return $this->dao->get_by_color_route($id);
    }
  }
?>
