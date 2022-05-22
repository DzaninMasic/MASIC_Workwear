<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  use Firebase\JWT\JWT;
  use Firebase\JWT\key;

  require_once 'C:\Bitnami\wampstack-8.1.3-0\apache2\htdocs\MASIC_Workwear\vendor\autoload.php';
  require_once 'C:\Bitnami\wampstack-8.1.3-0\apache2\htdocs\MASIC_Workwear\rest\services\MaterialService.class.php';
  require_once 'C:\Bitnami\wampstack-8.1.3-0\apache2\htdocs\MASIC_Workwear\rest\services\ColorsService.class.php';
  require_once 'C:\Bitnami\wampstack-8.1.3-0\apache2\htdocs\MASIC_Workwear\rest\dao\AdminsDao.class.php';

  Flight::register('adminsDao', 'AdminsDao');
  Flight::register('materialService', 'MaterialService');
  Flight::register('colorsService', 'ColorsService');
  Flight::register('adminService', 'AdminService');

  Flight::map('error', function(Exception $ex){
    Flight::json(['message' => $ex->getMessage()],500);
  });

  //middleware part
  Flight::route('/*', function(){ //every request will pass through this code
  //perform JWT decode
  $path = Flight::request()->url;
  if ($path == '/login') return TRUE; // exclude login route from middleware

  $headers = getallheaders();
if (@!$headers['Authorization']){
  Flight::json(["message" => "Authorization is missing"], 403);
  return FALSE;
}else{
  try {
    $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
    Flight::set('user', $decoded);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => "Authorization token is not valid"], 403);
    return FALSE;
  }
}
});

  require_once 'C:\Bitnami\wampstack-8.1.3-0\apache2\htdocs\MASIC_Workwear\rest\routes\ColorRoutes.php';
  require_once 'C:\Bitnami\wampstack-8.1.3-0\apache2\htdocs\rest\routes\MaterialRoutes.php';
  require_once 'C:\Bitnami\wampstack-8.1.3-0\apache2\htdocs\rest\routes\AdminRoutes.php';
  Flight::start();
?>
