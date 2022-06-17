<?php
  require_once __DIR__.'/BaseService.class.php';
  require_once __DIR__.'/../dao/MaterialDao.class.php';

  class MaterialService extends BaseService{

    public function add($entity){
      try {
        return $this->dao->add($entity);
      } catch (\Exception $e) {
        if (str_contains($e->getMessage(), 'SQLSTATE[23000]')) {
            throw new Exception('Material with the same name and color exists.');
        }
        else {
          throw $e;
        }
      }

      //return $this->dao->add($entity);
    }

    public function __construct(){
      parent::__construct(new MaterialDao());
    }

    public function get_by_color_route($id){
      return $this->dao->get_by_color_route($id);
    }

    public function get_all_updated(){
      return $this->dao->get_all_updated();
    }
  }
?>
