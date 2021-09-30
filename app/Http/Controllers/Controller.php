<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Dokumentasi Kece",
     *      description="Dokumentasi endpoint lumen - swagger",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=SWAGGER_LUME_CONST_HOST,
     *      description="Demo API Server"
     * )
     * 
     * @OA\SecurityScheme(
     *     securityScheme="bearerAuth",
     *     in="header",
     *     name="bearerAuth",
     *     type="http",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     * ),
     * 
     * @OA\SecurityDefinitions(
     *      bearer={
     *          type="apiKey",
     *          name="Authorization",
     *          in="header"
     *      }
     * )
     *
     * @OA\Tag(
     *     name="Projects",
     *     description="API Endpoints of Projects"
     * )
     */

    //^Schema

    /**
     * @OA\Schema(
     *  schema="CreateProvinsi",
     *  title="Create Provinsi Schema",
     * 	@OA\Property(
     * 		property="name",
     * 		type="string"
     * 	)
     * )
     */
    /**
     * @OA\Schema(
     *  schema="CreateProvinsiResult",
     *  title="Response Create Provinsi",
     * 	@OA\Property(
     * 		property="error",
     * 		type="boolean"
     * 	),
     * 	@OA\Property(
     * 		property="message",
     * 		type="string"
     * 	),
     * 	@OA\Property(
     * 		property="data",
     * 		type="object",
     *      @OA\Property(property="provinsi_id", type="integer"),
     *      @OA\Property(property="name", type="string")
     * 	),
     * )
     */

    /**
     * @OA\Schema(
     *  schema="UpdateProvinsiRequest",
     *  title="Create Provinsi Schema",
     * 	@OA\Property(
     * 		property="name",
     * 		type="string"
     * 	)
     * )
     */
    /**
     * @OA\Schema(
     *  schema="UpdateProvinsiResult",
     *  title="Response Update Porvinsi",
     * 	@OA\Property(
     * 		property="error",
     * 		type="boolean"
     * 	),
     * 	@OA\Property(
     * 		property="message",
     * 		type="string"
     * 	),
     * 	@OA\Property(
     * 		property="data",
     * 		type="object",
     *      @OA\Property(property="id", type="integer"),
     *      @OA\Property(property="name", type="string"),
     *      @OA\Property(property="created_at", type="string"),
     *      @OA\Property(property="updated_at", type="string")
     * 	),
     * )
     */

    /**
     * @OA\Schema(
     *  schema="CreateKabupatenRequest",
     *  title="Create Kabupaten Schema",
     * 	@OA\Property(property="name", type="string"),
     * 	@OA\Property(property="provinsi_id", type="integer")
     * )
     */
    /**
     * @OA\Schema(
     *  schema="CreateKabupatenResult",
     *  title="Response Create Kabupaten",
     * 	@OA\Property(
     * 		property="error",
     * 		type="boolean"
     * 	),
     * 	@OA\Property(
     * 		property="message",
     * 		type="string"
     * 	),
     * 	@OA\Property(
     * 		property="data",
     * 		type="object",
     *      @OA\Property(property="kabupaten_id", type="integer"),
     *      @OA\Property(property="name", type="string"),
     *      @OA\Property(property="provinsi", type="pbject",
     *          @OA\Property(property="provinsi_id", type="integer"),
     *          @OA\Property(property="name", type="string")
     *      )
     * 	),
     * )
     */

    /**
     * @OA\Schema(
     *  schema="UpdateKabupatenRequest",
     *  title="Create Kabupaten Schema",
     * 	@OA\Property(
     * 		property="name",
     * 		type="string"
     * 	),
     * 	@OA\Property(
     * 		property="provinsi_id",
     * 		type="integer"
     * 	),
     * )
     */
    /**
     * @OA\Schema(
     *  schema="UpdateKabupatenResult",
     *  title="Response Update Porvinsi",
     * 	@OA\Property(
     * 		property="error",
     * 		type="boolean"
     * 	),
     * 	@OA\Property(
     * 		property="message",
     * 		type="string"
     * 	),
     * 	@OA\Property(
     * 		property="data",
     * 		type="object",
     *      @OA\Property(property="id", type="integer"),
     *      @OA\Property(property="provinsi_id", type="integer"),
     *      @OA\Property(property="name", type="string"),
     *      @OA\Property(property="created_at", type="string"),
     *      @OA\Property(property="updated_at", type="string")
     * 	),
     * )
     */

    public function getThings(Request $request, $category)
    {
        $criteria = $request->input("criteria");
        if (!isset($category)) {
            return response()->json(null, Response::HTTP_BAD_REQUEST);
        }

        return response()->json(["criteria" => $criteria]);
    }
}
