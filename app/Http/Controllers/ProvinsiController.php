<?php

namespace App\Http\Controllers;

use App\Http\Resources\Provinsi\CompactProvinsiResource;
use App\Http\Resources\Provinsi\ProvinsiCollection;
use App\Http\Resources\Provinsi\ProvinsiResource;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinsiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/provinsi",
     *     summary="Get List of Provinsi",
     *     operationId="index",
     *     tags={"Provinsi"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns all area data",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(type="object",
     *                     @OA\Property(property="provinsi_id", type="integer"),
     *                     @OA\Property(property="name", type="string"),
     *                     @OA\Property(property="list_kabupaten", type="array",
     *                         @OA\Items(type="object",
     *                             @OA\Property(property="kabupaten_id", type="integer"),
     *                             @OA\Property(property="name", type="string")
     *                         )
     *                     ),
     *                 )
     *             ),
     *             @OA\Property(property="links", type="object",
     *                 @OA\Property(property="first", type="string"),
     *                 @OA\Property(property="last", type="string"),
     *                 @OA\Property(property="prev", type="string"),
     *                 @OA\Property(property="next", type="string")
     *             ),
     *             @OA\Property(property="meta", type="object",
     *                 @OA\Property(property="current_page", type="integer"),
     *                 @OA\Property(property="from", type="integer"),
     *                 @OA\Property(property="last_page", type="integer"),
     *                 @OA\Property(property="path", type="string"),
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(property="to", type="integer"),
     *                 @OA\Property(property="total", type="integer"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Internal Server Error",
     *     ),
     * )
     */
    public function index()
    {
        $provinsi = Provinsi::paginate();
        return new ProvinsiCollection($provinsi);
    }

    /**
     * @OA\Post(
     *   path="/api/create-provinsi",
     *   tags={"Provinsi"},
     *   summary="Create New Provinsi",
     *   operationId="createProvinsi",
     *   @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/CreateProvinsi")
     *       )
     *   ),
     *   @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *            type="object",
     *           oneOf={
     *               @OA\Schema(ref="#/components/schemas/CreateProvinsiResult"),
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
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required"
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 400);
        }

        $provinsi = Provinsi::create($request->all());

        return response()->json(["error" => false, "message" => "Success create provinsi", "data" => new CompactProvinsiResource($provinsi)]);
    }

    /**
     * @OA\Get(
     *     path="/api/provinsi/{provinsi_id}",
     *     summary="Get Provinsi By ID",
     *     operationId="/provinsi/provinsiId",
     *     tags={"Provinsi"},
     *     @OA\Parameter(
     *         name="provinsi_id",
     *         in="path",
     *         description="The id of provinsi",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Show Provinsi data",
     *         @OA\JsonContent(type="object",
     *             @OA\Property(property="provinsi_id", type="integer"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="list_kabupaten", type="array",
     *                 @OA\Items(type="object",
     *                     @OA\Property(property="kabupaten_id", type="integer"),
     *                     @OA\Property(property="name", type="string")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Something went wrong...",
     *     ),
     * )
     */
    public function show($id)
    {
        try {
            $provinsi = Provinsi::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(["error" => true,  "message" => "provinsi not found"], 404);
        }

        return new ProvinsiResource($provinsi);
    }

    /**
     * @OA\Put(
     *   path="/api/update-provinsi/{provinsi_id}",
     *   tags={"Provinsi"},
     *   summary="Update Provinsi",
     *   operationId="updateProvinsi",
     *   @OA\Parameter(
     *       name="provinsi_id",
     *       in="path",
     *       description="The id of provinsi",
     *       required=true,
     *       @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/UpdateProvinsiRequest")
     *       )
     *   ),
     *   @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *            type="object",
     *           oneOf={
     *               @OA\Schema(ref="#/components/schemas/UpdateProvinsiResult"),
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
    public function update(Request $request, $id)
    {
        try {
            Provinsi::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(["error" => true, "message" => "provinsi not found"], 404);
        }

        Provinsi::where('id', $id)
            ->update($request->only('name'));

        $provinsi_data = Provinsi::where('id', $id)->first();

        return response()->json(["error" => false, "message" => "provinsi updated successfully", "data" => $provinsi_data]);
    }

    /**
     * @OA\Delete(
     *   path="/api/delete-provinsi/{provinsi_id}",
     *   tags={"Provinsi"},
     *   summary="Delete Provinsi",
     *   operationId="deleteProvinsi",
     *   @OA\Parameter(
     *       name="provinsi_id",
     *       in="path",
     *       description="The id of provinsi",
     *       required=true,
     *       @OA\Schema(type="string")
     *   ),
     *   @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="boolean"),
     *             @OA\Property(property="message", type="string")
     *       )
     *   ),
     *   @OA\Response(
     *       response=400,
     *       description="Bad Request"
     *   )
     * )
     */
    public function delete($id)
    {
        try {
            $provinsi = Provinsi::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(["error" => true, "message" => "provinsi not found"], 404);
        }

        if ($provinsi->delete()) {
            return response()->json(["error" => false, "message" => "provinsi deleted"], 200);
        }

        return response()->json(["error" => true, "message" => "error deleting provinsi"], 500);
    }
}
