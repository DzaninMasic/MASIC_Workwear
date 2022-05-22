<?php
  require_once __DIR__.'/BaseService.class.php';
  require_once __DIR__.'/../dao/ZipperDao.class.php';

  class ZipperService extends BaseService{

    public function __construct(){
      parent::__construct(new ZipperDao()); //velcro na koji ce se vezati servis
    }


  }
?>
