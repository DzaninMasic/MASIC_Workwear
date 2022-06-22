<?php
  Flight::route('/print4', function(){
    echo "This is Dzanin 4 \n";
  });
  //GET ALL
  Flight::route('GET /brands', function(){
  Flight::json(Flight::brandsService()->get_all());
  });
  //GET INDIVIDUAL BY NAME
  Flight::route('GET /brands/@id', function($id){
    Flight::json(Flight::brandsService()->get_by_id($id));
  });
  //ADD
  Flight::route('POST /brands', function(){
    Flight::json(Flight::brandsService()->add(Flight::request()->data->getData()));
  });
  //UPDATE
  Flight::route('PUT /brands/@id', function($id){
    $data = Flight::request()->data->getData();
    //$data['id'] = $id;
    Flight::json(Flight::brandsService()->update($id, $data));
  });
  //DELETE
  Flight::route('DELETE /brands/@id', function($id){
    Flight::brandsService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

?>
