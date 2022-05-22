<?php
  Flight::route('/print3', function(){
    echo "This is Dzanin 3 \n";
  });
  //GET ALL
  Flight::route('GET /buttons', function(){
  Flight::json(Flight::buttonsService()->get_all());
  });
  //GET INDIVIDUAL BY NAME
    Flight::route('GET /buttons/@id', function($id){
    Flight::json(Flight::buttonsService()->get_by_id($id));
  });
  //GET INDIVIDUAL BY COLOR_ID WHICH INCLUDES THE NAME OF THE Color
  /*Flight::route('GET /buttons/@id', function($id){
    Flight::json(Flight::buttonsService()->get_by_color_route($id));
  });*/
  //GET INDIVIDUAL BY COLOR
/*  Flight::route('GET /buttons/@id/colors', function($id){
    Flight::json(Flight::colorsService()->get_material_by_color_id($id));
  });*/
  //ADD
  Flight::route('POST /buttons', function(){
    Flight::json(Flight::buttonsService()->add(Flight::request()->data->getData()));
  });
  //UPDATE
  Flight::route('PUT /buttons/@id', function($id){
    $data = Flight::request()->data->getData();
    //$data['id'] = $id;
    Flight::json(Flight::buttonsService()->update($id, $data));
  });
  //DELETE
  Flight::route('DELETE /buttons/@id', function($id){
    Flight::buttonsService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

?>
