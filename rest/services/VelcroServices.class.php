<?php
  require_once __DIR__.'/BaseService.class.php';
  require_once __DIR__.'/../dao/VelcroDao.class.php';

  class VelcroService extends BaseService{

    public function __construct(){
      parent::__construct(new VelcroDao()); //velcro na koji ce se vezati servis
    }


  }
?>
