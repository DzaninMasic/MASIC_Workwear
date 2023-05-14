<?php
  //GET ALL
  Flight::route('GET /types', function(){
  Flight::json(Flight::typesService()->getAll());
  });
  //GET INDIVIDUAL BY NAME
  Flight::route('GET /types/@id', function($id){
    Flight::json(Flight::typesService()->getById($id));
  });
  //ADD
  Flight::route('POST /types', function(){
    Flight::json(Flight::typesService()->add(Flight::request()->data->getData()));
  });
  //UPDATE
  Flight::route('PUT /types/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::typesService()->update($id, $data));
  });
  //DELETE
  Flight::route('DELETE /types/@id', function($id){
    Flight::typesService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

?>
