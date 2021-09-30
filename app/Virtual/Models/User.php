/**
* @OA\Schema(
* title="User",
* description="User model",
* @OA\Xml(
* name="User"
* )
* )
*/

class Project
{

/**
* @OA\Property(
* title="ID",
* description="ID",
* format="int64",
* example=1
* )
*
* @var integer
*/
private $id;

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

/**
* @OA\Property(
* title="Created at",
* description="Created at",
* example="2020-01-27 17:50:45",
* format="datetime",
* type="string"
* )
*
* @var \DateTime
*/
private $created_at;

/**
* @OA\Property(
* title="Updated at",
* description="Updated at",
* example="2020-01-27 17:50:45",
* format="datetime",
* type="string"
* )
*
* @var \DateTime
*/
private $updated_at;
}