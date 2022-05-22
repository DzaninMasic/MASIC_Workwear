<?php
  Flight::route('/print4', function(){
    echo "This is Dzanin 4 \n";
  });
  //GET ALL
  Flight::route('GET /velcro', function(){
  Flight::json(Flight::velcroService()->get_all());
  });
  //GET INDIVIDUAL BY NAME
    Flight::route('GET /velcro/@id', function($id){
    Flight::json(Flight::velcroService()->get_by_id($id));
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
  Flight::route('POST /velcro', function(){
    Flight::json(Flight::velcroService()->add(Flight::request()->data->getData()));
  });
  //UPDATE
  Flight::route('PUT /velcro/@id', function($id){
    $data = Flight::request()->data->getData();
    //$data['id'] = $id;
    Flight::json(Flight::velcroService()->update($id, $data));
  });
  //DELETE
  Flight::route('DELETE /velcro/@id', function($id){
    Flight::velcroService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

?>
