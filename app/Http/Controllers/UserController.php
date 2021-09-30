<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

  /**
   * @OA\Post(
   *   path="/api/register",
   *   tags={"auth"},
   *   summary="Create user",
   *   description="Register new user",
   *   operationId="register",
   *   @OA\RequestBody(
   *       @OA\MediaType(
   *           mediaType="application/json",
   *           @OA\Schema(
   *               @OA\Property(
   *                   property="name",
   *                   type="string"
   *               ),
   *               @OA\Property(
   *                   property="email",
   *                   type="string"
   *               ),
   *               @OA\Property(
   *                   property="password",
   *                   type="string"
   *               ),
   *               example={"name": "Ariq Jusuf", "email": "ariq2901@gmail.com", "password": "passworKu"}
   *           )
   *       )
   *   ),
   *   @OA\Response(
   *         response=201,
   *         description="OK",
   *         @OA\JsonContent(
   *           type="object",
   *           oneOf={
   *               @OA\Schema(ref="#/components/schemas/RegisterResult"),
   *               @OA\Schema(type="boolean")
   *           }
   *       )
   *   ),
   *   @OA\Response(
   *       response=400,
   *       description="Bad Request"
   *   )
   * )
   */

  /**
   * @OA\Schema(
   *  schema="RegisterResult",
   *  title="Register Schema",
   * 	@OA\Property(
   * 		property="message",
   * 		type="string"
   * 	),
   * 	@OA\Property(
   * 		property="user",
   * 		type="object",
   *    @OA\Property(
   *        property="name",
   *        type="string"
   *    ),
   *    @OA\Property(
   *        property="email",
   *        type="string"
   *    ),
   *    @OA\Property(
   *        property="updated_at",
   *        type="string"
   *    ),
   *    @OA\Property(
   *        property="created_at",
   *        type="string"
   *    ),
   *    @OA\Property(
   *        property="id",
   *        type="integer"
   *    )
   * 	),
   *  @OA\Property(
   *    property="token",
   *    type="string"
   *  ),
   *  example={
   *    "message": "successfully registered",
   *    "user": {
   *      "name": "ariq jusuf",
          "email": "ariq2901@gmail.com",
          "updated_at": "2021-07-14T02:43:30.000000Z",
          "created_at": "2021-07-14T02:43:30.000000Z",
          "id": 2
        },
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzdi"
      }
   * )
   */
  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json(["error" => $validator->errors()], 400);
    }

    $input = $request->all();
    $input['password'] = Hash::make($input['password']);
    $user = User::create($input);

    $token = $user->createToken('nApp')->accessToken;

    return response()->json(["message" => "successfully registered", "user" => $user, "token" => $token], 201);
  }

  /**
   * @OA\Post(
   *   path="/api/oauth/token",
   *   tags={"auth"},
   *   summary="Login user",
   *   description="User Login",
   *   operationId="login",
   *   @OA\RequestBody(
   *       @OA\MediaType(
   *           mediaType="application/json",
   *           @OA\Schema(
   *               @OA\Property(
   *                   property="username",
   *                   type="string"
   *               ),
   *               @OA\Property(
   *                   property="password",
   *                   type="string"
   *               ),
   *               @OA\Property(
   *                   property="grant_type",
   *                   type="string"
   *               ),
   *               @OA\Property(
   *                   property="client_id",
   *                   type="integer"
   *               ),
   *               @OA\Property(
   *                   property="client_secret",
   *                   type="string"
   *               ),
   *               example={"username": "ariq2901@gmail.com", "password": "passwordKu", "grant_type": "password", "client_id": 2, "client_secret": "9ismoDyOkW9SKTcJBkznYpqo6swIMp7IaQecza8e"}
   *           )
   *       )
   *   ),
   *   @OA\Response(
   *         response=200,
   *         description="OK",
   *         @OA\JsonContent(
   *            type="object",
   *           oneOf={
   *               @OA\Schema(ref="#/components/schemas/LoginResult"),
   *               @OA\Schema(type="boolean")
   *           }
   *       )
   *   ),
   *   @OA\Response(
   *       response=400,
   *       description="Bad Request"
   *   )
   * )
   */

  /**
   * @OA\Schema(
   *  schema="LoginResult",
   *  title="Login Schema",
   * 	@OA\Property(
   * 		property="token_type",
   * 		type="string"
   * 	),
   * 	@OA\Property(
   * 		property="expires_in",
   * 		type="integer"
   * 	),
   *  @OA\Property(
   *    property="access_token",
   *    type="string"
   *  ),
   *  @OA\Property(
   *    property="refresh_token",
   *    type="string"
   *  ),
   *  example={
   *    "token": "Bearer",
   *    "expires_in": 31536000,
   *    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzdiNDgzNGZlNzBhODNjMTdiOTllZDgwNGVkZDU5ZDRmNGM3MTI5MTUyYTQxZjVmOTgxNTkxNzhiMjFkOGNmMThmNDE2ZDFiZjRlOTZhZDgiLCJpYXQiOjE2MjYyMzA2MTEsIm5iZiI6MTYyNjIzMDYxMSwiZXhwIjoxNjU3NzY2NjEwLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.ws9EZVWvWlznzvU4sLMh1n_nEQVH4B-Wr4hBS5ejBrp7eham8fNNLGZpmgp8ipt10N-IQE_kL8Oov-gWRJ4Eyrllz66K-wiCmkv3KciU5tYc1rg9AozlpnQvMmcEqi8UyFYGOfUw8dxlhczMCjDt3QUu36JAO7yRNY-mXLBMNE3KIxag7_J6vQ-Wadx1HpAMiiDCWQfRr4PJlYIfKJQrfY_4GFADlKSM4VcLqcDN8Tvq6gu5RWFVvavr8WGcorvB9AKLTYVFPQxlzcJH6GtaZ95qxF5vKiIMZxUjx77zTbHdZRINAuejYqCn8fDSXlq-qrGnMwI57jdHF7EajXAXoZ6N8MXFbeiiDTpDEh_Z55RawR4ngAkPMBXOZFX32q6VnpT6BkyE4HkOawNmIurS3peEnSjpz1joikrcd5L6BsGB2eDULqK4WNLcDcdUtOjT_JkhXvZF8mGMO95-43lUL2O81zrpl5YvI0Rebiqz8jRM4wTd7CeW3fMGSyEvdYsfde6C7VT2R7mz3uLN76Cy0nTMfcuBv7D5nY-YNBJqdrw0TJGOP8N64fmOd9azsh2hMZayDeNE1BcEjv4I6MDsgTHWkDBgYN_YjcE8zZswiUsqyqNALw4WLQVZ9Ir0ov8rAUCdFU3hjFIMTgzHla1x2pkgTLaz1MkGoT3pp_pT6gY",
   *    "refresh_token": "def50200cca226564ded2d2110a9333f54ab67418677c4d55e815c75c0cb4edfc317f4ecc32162d66d53f4db033afc5f8ca27630096b34de28f718a9686cecea010eb67d740391db124ceaa43fa39a69d555fa63cd6d6c5a5e1951a047ee8bf3529e4fadbd0c27ca1fd9badaf46e8890b739d09264526dd07f4593456343e8fcbd7de287c168aedd7b70ddeaad4793"
      }
   * )
   */
  public function login()
  {
    if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
      $user = Auth::user();
      $data['token'] = $user->createToken('nApp')->accessToken;
      return response()->json(["token" => $data], 200);
    } else {
      return response()->json(["error" => "Unauthorized"], 400);
    }
  }

  /**
   * @OA\Get(
   *     path="/api/logout",
   *     summary="Logout",
   *     operationId="/logout",
   *     description="Logout & Revoke User Token",
   *     tags={"auth"},
   *     security={{"bearerAuth": {}}},
   *     @OA\Response(
   *         response="200",
   *         description="Successfully logged out",
   *         @OA\JsonContent(type="object",
   *             @OA\Property(property="message", type="string")
   *         )
   *     ),
   *     @OA\Response(
   *         response="401",
   *         description="Unauthorized",
   *     ),
   * )
   */
  public function logout()
  {
    try {
      Auth::user()->token()->revoke();
    } catch (\Throwable $th) {
      return response()->json(["message" => "Failed to logout"], 500);
    }

    return response()->json(["message" => "Successfully loged out"], 200);
  }

  /**
   * @OA\Get(
   *     path="/api/profile",
   *     summary="Get Profile",
   *     operationId="profile",
   *     description="Get User Profile",
   *     tags={"user"},
   *     security={{"bearerAuth": {}}},
   *     @OA\Response(
   *         response="200",
   *         description="Get User Data.",
   *         @OA\JsonContent(type="object",
   *             @OA\Property(property="user", type="object",
   *                 @OA\Property(property="id", type="integer"),
   *                 @OA\Property(property="name", type="string"),
   *                 @OA\Property(property="email", type="string"),
   *                 @OA\Property(property="created_at", type="string"),
   *                 @OA\Property(property="updated_at", type="string")
   *             )
   *         )
   *     ),
   *     @OA\Response(
   *         response="401",
   *         description="Unauthorized",
   *     ),
   * )
   */
  public function userDetail()
  {
    $user = Auth::user();

    return response()->json(["user" => $user], 200);
  }
}
