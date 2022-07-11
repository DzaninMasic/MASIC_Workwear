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

  //SHOW TOTAL LENGTH FOR EACH COLOR
  Flight::route('GET /length', function(){
  Flight::json(Flight::materialService()->color_length());
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

  /**
  * @OA\Post(
  *     path="/material",
  *     description="Add material",
  *     tags={"material"},
  *     security = {{"ApiKeyAuth": {}}},
  *   @OA\RequestBody(description="Add material", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="brand_id", type="[string]", example="3",	description="ID of Brand name" ),
  *    				 @OA\Property(property="type_id", type="[string]", example="1",	description="ID of Type name" ),
  *            @OA\Property(property="color_id", type="[string]", example="2",	description="ID of Color name" ),
  *            @OA\Property(property="Available", type="[string]", example="YES",	description="Check if available" ),
  *            @OA\Property(property="Length", type="[string]", example="69",	description="Length of material" ),
  *          )
  *       )),
  *     @OA\Response(
  *         response=200,
  *         description="Material added",
  *
  *     ),
  *     @OA\Response(
  *         response=404,
  *         description="unauthorized",
  *     )
  * )
  */
//  *     security={{"ApiKeyAuth": {}},
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

  /**
  *   @OA\Delete(
  *     path="/material/{id}", security={{"ApiKeyAuth": {}}},
  *     description="Hard delete material",
  *     tags={"material"},
  *     @OA\Parameter(in="path", name="id", example=1, description="Id of material"),
  *     @OA\Response(
  *         response=200,
  *         description="Material deleted"
  *     ),
  *     @OA\Response(
  *         response=500,
  *         description="Error, may indicate JWT abuse"
  *     )
  * )
  */

  //DELETE
  Flight::route('DELETE /material/@id', function($id){
    Flight::materialService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

?>
