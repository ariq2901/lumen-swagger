<?php

namespace App\Http\Controllers;

use App\Http\Resources\Kabupaten\KabupatenCollection;
use App\Http\Resources\Kabupaten\KabupatenResource;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KabupatenController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/kabupaten",
     *     summary="Get List Kabupaten",
     *     operationId="getKabupaten",
     *     tags={"Kabupaten"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns all area data",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="kabupaten", type="array",
     *                 @OA\Items(type="object",
     *                     @OA\Property(property="kabupaten_id", type="integer"),
     *                     @OA\Property(property="name", type="string"),
     *                     @OA\Property(property="provinsi", type="object",
     *                         @OA\Property(property="provinsi_id", type="integer"),
     *                         @OA\Property(property="name", type="string")
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
        $kabupaten_list = Kabupaten::paginate();
        return new KabupatenCollection($kabupaten_list);
    }

    /**
     * @OA\Get(
     *     path="/api/kabupaten/{kabupaten_id}",
     *     summary="Get Kabupaten Data By ID",
     *     operationId="/kabupaten/kabupatenId",
     *     tags={"Kabupaten"},
     *     @OA\Parameter(
     *         name="kabupaten_id",
     *         in="path",
     *         description="The id of kabupaten",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Show kabupaten data",
     *         @OA\JsonContent(type="object",
     *             @OA\Property(property="kabupaten_id", type="integer"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="provinsi", type="object",
     *                 @OA\Property(property="provinsi_id", type="integer"),
     *                 @OA\Property(property="name", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Kabupaten Not Found",
     *     ),
     * )
     */
    public function show($id)
    {
        try {
            $kabupaten = Kabupaten::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(["error" => true,  "message" => "Kabupaten not found"], 404);
        }

        return new KabupatenResource($kabupaten);
    }

    /**
     * @OA\Post(
     *   path="/api/create-kabupaten",
     *   tags={"Kabupaten"},
     *   summary="Create New Kabupaten",
     *   operationId="createKabupaten",
     *   @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/CreateKabupatenRequest")
     *       )
     *   ),
     *   @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *            type="object",
     *           oneOf={
     *               @OA\Schema(ref="#/components/schemas/CreateKabupatenResult"),
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
            'name' => "required",
            'provinsi_id' => "required"
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 400);
        }

        $kabupaten = Kabupaten::create($request->only(['name', 'provinsi_id']));

        return response()->json(["error" => false, "message" => "Success create kabupaten", "data" => new KabupatenResource($kabupaten)]);
    }

    /**
     * @OA\Put(
     *   path="/api/update-kabupaten/{kabupaten_id}",
     *   tags={"Kabupaten"},
     *   summary="Update Kabupaten",
     *   operationId="updateKabupaten",
     *   @OA\Parameter(
     *       name="kabupaten_id",
     *       in="path",
     *       description="The id of kabupaten",
     *       required=true,
     *       @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/UpdateKabupatenRequest")
     *       )
     *   ),
     *   @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *            type="object",
     *           oneOf={
     *               @OA\Schema(ref="#/components/schemas/UpdateKabupatenResult"),
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
            Kabupaten::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(["error" => true, "message" => "provinsi not found"], 404);
        }

        Kabupaten::where('id', $id)
            ->update($request->only(['name', 'provinsi_id']));

        $kabupaten_data = Kabupaten::where('id', $id)->first();

        return response()->json(["error" => false, "message" => "kabupaten updated successfully", "data" => $kabupaten_data]);
    }

    /**
     * @OA\Delete(
     *   path="/api/delete-kabupaten/{kabupaten_id}",
     *   tags={"Kabupaten"},
     *   summary="Delete Kabupaten",
     *   operationId="deleteKabupaten",
     *   @OA\Parameter(
     *       name="kabupaten_id",
     *       in="path",
     *       description="The id of kabupaten",
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
            $kabupaten = Kabupaten::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(["error" => true, "message" => "kabupaten not found"], 404);
        }

        if ($kabupaten->delete()) {
            return response()->json(["error" => false, "message" => "kabupaten deleted"], 200);
        }

        return response()->json(["error" => true, "message" => "error deleting kabupaten"], 500);
    }
}
