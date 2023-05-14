<?php
  require_once __DIR__.'/BaseService.class.php';
  require_once __DIR__.'/../dao/BrandsDao.class.php';

  class BrandsService extends BaseService{

    public function __construct(){
      parent::__construct(BrandsDao::getInstance());
    }
    
    public function getMaterialByBrandId($brandId){
      return $this->dao->getMaterialByBrandId($brandId);
    }
  }
?>
