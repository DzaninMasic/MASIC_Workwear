<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'C:\Bitnami\wampstack-8.1.2-0\apache2\htdocs\MASIC_Workwear\vendor\autoload.php';
require_once 'C:\Bitnami\wampstack-8.1.2-0\apache2\htdocs\MASIC_Workwear\rest\dao\ProjectDao.class.php';
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
});

Flight::start();
 ?>
