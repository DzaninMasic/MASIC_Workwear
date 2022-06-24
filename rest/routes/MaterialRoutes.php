<?php

  Flight::route('/print', function(){
    echo "This is Dzanin \n";
  });

  /**
 * @OA\Get(
 *      path="/material/",
 *      tags={"material"},
 *      summary="Returns all materials from the api. ",
 *      security = {{"ApiKeyAuth": {}}},
 *      @OA\Response(
 *          response=200,
 *          description="List of materials"
 *      )
 * )
 */

  //GET ALL
  Flight::route('GET /material', function(){
  Flight::json(Flight::materialService()->get_all_updated());
  });

  //GET SEARCHED
  Flight::route('GET /search/@name', function($name){
  Flight::json(Flight::materialService()->get_searched($name));
  });

  //FILTER
  Flight::route('GET /filter/@type/@order', function($type, $order){
  Flight::json(Flight::materialService()->filter_search($type, $order));
  });
  /**
 * @OA\Get(path="/material/{id}", tags={"material"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of material"),
 *     @OA\Response(response="200", description="Fetch individual material")
 * )
 */


  /*Flight::route('GET /material', function(){
  Flight::json(Flight::materialService()->get_all());
  });*/
  //GET INDIVIDUAL BY NAME
  /*Flight::route('GET /material/@id', function($id){
    Flight::json(Flight::materialService()->get_by_id($id));
  });*/
  //GET INDIVIDUAL BY COLOR_ID WHICH INCLUDES THE NAME OF THE Color
  Flight::route('GET /material/@id', function($id){
    Flight::json(Flight::materialService()->get_by_color_route($id));
  });

  //GET INDIVIDUAL BY COLOR
  Flight::route('GET /material/@id/colors', function($id){
    Flight::json(Flight::colorsService()->get_material_by_color_id($id));
  });
  //ADD
  Flight::route('POST /material', function(){
    Flight::json(Flight::materialService()->add(Flight::request()->data->getData()));
  });
  //UPDATE
  Flight::route('PUT /material/@id', function($id){
    $data = Flight::request()->data->getData();
    //$data['id'] = $id;
    Flight::json(Flight::materialService()->update($id, $data));
  });
  //DELETE
  Flight::route('DELETE /material/@id', function($id){
    Flight::materialService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

?>
