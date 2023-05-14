<?php
  require_once __DIR__.'/BaseService.class.php';
  require_once __DIR__.'/../dao/AdminsDao.class.php';

  class AdminService extends BaseService{

    public function __construct(){
      parent::__construct(AdminsDao::getInstance());
    }
    
    public function getAdminByEmail($email){
        return $this->dao->getAdminByEmail($email);
    }
  }
?>
