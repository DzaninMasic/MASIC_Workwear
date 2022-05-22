<?php
  Flight::route('/print2', function(){
    echo "This is Dzanin 2 \n";
  });
  //GET ALL
  Flight::route('GET /colors', function(){
  Flight::json(Flight::colorsService()->get_all());
  });
  //GET INDIVIDUAL BY NAME
  Flight::route('GET /colors/@id', function($id){
    Flight::json(Flight::colorsService()->get_by_id($id));
  });
  //ADD
  Flight::route('POST /colors', function(){
    Flight::json(Flight::colorsService()->add(Flight::request()->data->getData()));
  });
  //UPDATE
  Flight::route('PUT /colors/@id', function($id){
    $data = Flight::request()->data->getData();
    //$data['id'] = $id;
    Flight::json(Flight::colorsService()->update($id, $data));
  });
  //DELETE
  Flight::route('DELETE /colors/@id', function($id){
    Flight::colorsService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

?>
