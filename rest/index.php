<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  use Firebase\JWT\JWT;
  use Firebase\JWT\key;

  require_once '..\vendor\autoload.php';
  require_once 'services\MaterialService.class.php';
  require_once 'services\ColorsService.class.php';
  require_once 'services\TypesService.class.php';
  require_once 'services\BrandsService.class.php';
  require_once 'dao\AdminsDao.class.php';
  require_once 'dao\TypesDao.class.php';
  require_once 'dao\BrandsDao.class.php';

  Flight::register('adminsDao', 'AdminsDao');
  Flight::register('brandsDao', 'BrandsDao');
  Flight::register('materialService', 'MaterialService');
  Flight::register('colorsService', 'ColorsService');
  Flight::register('adminService', 'AdminService');
  Flight::register('typesService', 'TypesService');
  Flight::register('brandsService', 'BrandsService');

  Flight::map('error', function(Exception $ex){
    Flight::json(['message' => $ex->getMessage()],500);
  });
  //MIDDLEWARE
  Flight::route('/*', function(){
    //perform JWT decode
    $path = Flight::request()->url;
    if ($path == '/login' || $path == '/docs.json') return TRUE; // exclude login route from middleware

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

  Flight::route('GET /docs.json',function(){
    $openapi = \OpenApi\scan(['routes']);
    header('Content-Type: application/json');
    echo $openapi->toJson();
});

  require_once 'routes\ColorRoutes.php';
  require_once 'routes\MaterialRoutes.php';
  require_once 'routes\AdminRoutes.php';
  require_once 'routes\TypeRoutes.php';
  require_once 'routes\BrandRoutes.php';
  Flight::start();
?>
