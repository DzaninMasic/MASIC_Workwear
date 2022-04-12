<?php

require_once __DIR__.'/BaseDao.class.php';

class ProjectDao extends BaseDao{

  //CONSTRUCTOR
  public function __construct(){
    parent::__construct("material");
  }
}

?>
