<?php
  Flight::route('/print2', function(){
    echo "This is Dzanin 2 \n";
  });

  /**
 * @OA\Get(
 *      path="/colors/",
 *      tags={"colors"},
 *      summary="Returns all colors from the api. ",
 *      security = {{"ApiKeyAuth": {}}},
 *      @OA\Response(
 *          response=200,
 *          description="List of colors"
 *      )
 * )
 */

  //GET ALL
  Flight::route('GET /colors', function(){
  Flight::json(Flight::colorsService()->get_all());
  });

  /**
 * @OA\Get(path="/colors/{id}", tags={"colors"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of color"),
 *     @OA\Response(response="200", description="Fetch individual color")
 * )
 */
  
  //GET INDIVIDUAL COLOR
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
