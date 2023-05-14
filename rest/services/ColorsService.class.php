<?php
  require_once __DIR__.'/BaseService.class.php';
  require_once __DIR__.'/../dao/ColorsDao.class.php';

  class ColorsService extends BaseService{

    public function __construct(){
      parent::__construct(ColorsDao::getInstance());
    }

    public function add($entity){
      try {
        return $this->dao->add($entity);
      } catch (\Exception $e) {
        if (str_contains($e->getMessage(), 'SQLSTATE[23000]')) {
            throw new Exception('Color with the same name exists.');
        }
        else {
          throw $e;
        }
      }
      //return $this->dao->add($entity);
    }

    public function get_material_by_color_id($color_id){
      return $this->dao->get_material_by_color_id($color_id);
    }
  }
?>
