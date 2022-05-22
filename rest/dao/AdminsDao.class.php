<?php

require_once __DIR__.'/BaseDao.class.php';

class AdminsDao extends BaseDao{

  public function __construct(){
    parent::__construct("admins");
  }

  public function get_admin_by_email($email){
    return $this -> query_unique("SELECT * FROM admins WHERE email = :email", ['email' => $email]);
  }
}

 ?>
