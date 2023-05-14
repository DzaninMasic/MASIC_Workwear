<?php
  //GET ALL
  Flight::route('GET /brands', function(){
  Flight::json(Flight::brandsService()->getAll());
  });
  //GET INDIVIDUAL BY ID
  Flight::route('GET /brands/@id', function($id){
    Flight::json(Flight::brandsService()->getById($id));
  });
  //ADD
  Flight::route('POST /brands', function(){
    Flight::json(Flight::brandsService()->add(Flight::request()->data->getData()));
  });
  //UPDATE
  Flight::route('PUT /brands/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::brandsService()->update($id, $data));
  });
  //DELETE
  Flight::route('DELETE /brands/@id', function($id){
    Flight::brandsService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

?>
