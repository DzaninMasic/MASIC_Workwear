<?php
  require_once 'C:\xampp\htdocs\MASIC_Workwear\rest\Config.class.php';
  use Firebase\JWT\JWT;
  use Firebase\JWT\Key;

  //ADMIN LOGIN CHECK
  Flight::route('POST /login', function(){
    $login=Flight::request()->data->getData();

    $admin=Flight::adminsDao()->get_admin_by_email($login['email']);

    if(isset($admin['id'])){
      if($admin['password']==md5($login['password'])){
        unset($admin['password']);
        $jwt = JWT::encode($admin, Config::JWT_SECRET(), 'HS256');
        Flight::json(['token'=>$jwt]);
      }else {
        Flight::json(["message"=>"Incorrect password"],404);
      }
    }else{
      Flight::json(["message"=>"Admin doesn't exist"],404);
    }
  });

?>
