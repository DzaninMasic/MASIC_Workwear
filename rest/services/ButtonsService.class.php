<?php

  require_once __DIR__.'/BaseService.class.php';
  require_once __DIR__.'/../dao/ButtonsDao.class.php';

  class ButtonsService extends BaseService{

    public function __construct(){
      parent::__construct(new ButtonsDao());
    }

  }

 ?>
