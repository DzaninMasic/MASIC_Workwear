<?php
  //GET ALL
  Flight::route('GET /brands', function(){
  Flight::json(Flight::brandService()->getAll());
  });
  //GET INDIVIDUAL BY ID
  Flight::route('GET /brands/@id', function($id){
    Flight::json(Flight::brandService()->getById($id));
  });
  //ADD
  Flight::route('POST /brands', function(){
    Flight::json(Flight::brandService()->add(Flight::request()->data->getData()));
  });
  //UPDATE
  Flight::route('PUT /brands/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::brandService()->update($id, $data));
  });
  //DELETE
  Flight::route('DELETE /brands/@id', function($id){
    Flight::brandService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

?>
