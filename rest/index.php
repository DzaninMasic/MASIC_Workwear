<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

<<<<<<< HEAD:rest/services/index.php
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
=======
require_once 'C:\Bitnami\wampstack-8.1.3-0\apache2\htdocs\MASIC_Workwear\vendor\autoload.php';
require_once 'C:\Bitnami\wampstack-8.1.3-0\apache2\htdocs\MASIC_Workwear\rest\dao\ProjectDao.class.php';
Flight::register('projectDao', 'ProjectDao');
Flight::route('/print', function(){
  echo "This is Dzanin \n";
});
//GET ALL
Flight::route('GET /material', function(){
Flight::json(Flight::projectDao()->get_all());
});
//GET INDIVIDUAL BY NAME
Flight::route('GET /material/@id', function($id){
  Flight::json(Flight::projectDao()->get_by_id($id));
});
//ADD
Flight::route('POST /material', function(){
  Flight::json(Flight::projectDao()->add(Flight::request()->data->getData()));
});
//UPDATE
Flight::route('PUT /material/@id', function($id){
  $data = Flight::request()->data->getData();
  $data['id'] = $id;
  Flight::json(Flight::projectDao()->update($data));
});
//DELETE
Flight::route('DELETE /material/@id', function($id){
  Flight::projectDao()->delete($id);
  Flight::json(["message" => "deleted"]);
>>>>>>> cc367beb6aaa8a121a25ad790f9e664aa4edd5be:rest/index.php
});

  require_once 'C:\Bitnami\wampstack-8.1.3-0\apache2\htdocs\MASIC_Workwear\rest\routes\ColorRoutes.php';
  require_once 'C:\Bitnami\wampstack-8.1.3-0\apache2\htdocs\rest\routes\MaterialRoutes.php';
  require_once 'C:\Bitnami\wampstack-8.1.3-0\apache2\htdocs\rest\routes\AdminRoutes.php';
  Flight::start();
?>
