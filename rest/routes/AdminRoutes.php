<?php
  require_once '.\Config.class.php';
  use Firebase\JWT\JWT;
  use Firebase\JWT\Key;

/**
* @OA\Post(
*     path="/login",
*     description="Login to the system",
*     tags={"material"},
*   @OA\RequestBody(description="Basic admin info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				 @OA\Property(property="email", type="[string]", example="kenan.lokvancic@stu.ibu.edu.ba",	description="Email" ),
*    				 @OA\Property(property="password", type="[string]", example="1234",	description="Password" )
*
*          )
*       )),
*     @OA\Response(
*         response=200,
*         description="JWT Token on successful response",
*
*     ),
*     @OA\Response(
*         response=404,
*         description="unauthorized",
*     )
* )
*/

  //ADMIN LOGIN CHECK
  Flight::route('POST /login', function(){
    $login=Flight::request()->data->getData();

    $admin=Flight::adminsDao()->get_admin_by_email($login['email']);

    if(isset($admin['id'])){
      if($admin['password']==md5($login['password'])){
        unset($admin['password']);
        $jwt = JWT::encode($admin, Config::JWT_SECRET(), 'HS256');
        Flight::json(['token'=>$jwt]);
      }else {
        Flight::json(["message"=>"Incorrect password"],404);
      }
    }else{
      Flight::json(["message"=>"Admin doesn't exist"],404);
    }
  });

?>
