<?php
  Flight::route('/print5', function(){
    echo "This is Dzanin 5 \n";
  });
  //GET ALL
  Flight::route('GET /zippers', function(){
  Flight::json(Flight::zipperService()->get_all());
  });
  //GET INDIVIDUAL BY NAME
    Flight::route('GET /zippers/@id', function($id){
    Flight::json(Flight::zipperService()->get_by_id($id));
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
  Flight::route('POST /zippers', function(){
    Flight::json(Flight::zipperService()->add(Flight::request()->data->getData()));
  });
  //UPDATE
  Flight::route('PUT /zippers/@id', function($id){
    $data = Flight::request()->data->getData();
    //$data['id'] = $id;
    Flight::json(Flight::zipperService()->update($id, $data));
  });
  //DELETE
  Flight::route('DELETE /zippers/@id', function($id){
    Flight::zipperService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

?>
