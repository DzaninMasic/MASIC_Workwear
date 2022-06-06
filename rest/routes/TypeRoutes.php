<?php
  Flight::route('/print3', function(){
    echo "This is Dzanin 3 \n";
  });
  //GET ALL
  Flight::route('GET /types', function(){
  Flight::json(Flight::typesService()->get_all());
  });
  //GET INDIVIDUAL BY NAME
  Flight::route('GET /types/@id', function($id){
    Flight::json(Flight::typesService()->get_by_id($id));
  });
  //ADD
  Flight::route('POST /types', function(){
    Flight::json(Flight::typesService()->add(Flight::request()->data->getData()));
  });
  //UPDATE
  Flight::route('PUT /types/@id', function($id){
    $data = Flight::request()->data->getData();
    //$data['id'] = $id;
    Flight::json(Flight::typesService()->update($id, $data));
  });
  //DELETE
  Flight::route('DELETE /types/@id', function($id){
    Flight::typesService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

?>
