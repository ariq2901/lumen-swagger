/**
* @OA\Schema(
* title="Register User request",
* description="Register User request body data",
* type="object",
* required={"name", "email", "password"}
* )
*/

class RegisterUserRequest
{
/**
* @OA\Property(
* title="Name",
* description="User Name",
* example="Ariq Jusuf"
* )
*
* @var string
*/
public $name;

/**
* @OA\Property(
* title="Email",
* description="User Email",
* example="ariq2901@gmail.com"
* )
*
* @var string
*/
public $email;

/**
* @OA\Property(
* title="Password",
* description="User Password",
* example="passwordKu"
* )
*
* @var string
*/
public $password;
}