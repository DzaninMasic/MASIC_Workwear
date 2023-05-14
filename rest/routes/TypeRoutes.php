<?php
  //GET ALL
  Flight::route('GET /types', function(){
  Flight::json(Flight::typeService()->getAll());
  });
  //GET INDIVIDUAL BY NAME
  Flight::route('GET /types/@id', function($id){
    Flight::json(Flight::typeService()->getById($id));
  });
  //ADD
  Flight::route('POST /types', function(){
    Flight::json(Flight::typeService()->add(Flight::request()->data->getData()));
  });
  //UPDATE
  Flight::route('PUT /types/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::typeService()->update($id, $data));
  });
  //DELETE
  Flight::route('DELETE /types/@id', function($id){
    Flight::typeService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

?>
