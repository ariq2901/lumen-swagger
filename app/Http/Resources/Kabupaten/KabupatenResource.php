<?php

namespace App\Http\Resources\Kabupaten;

use App\Http\Resources\Provinsi\CompactProvinsiResource;
use App\Models\Provinsi;
use Illuminate\Http\Resources\Json\JsonResource;

class KabupatenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $provinsi = Provinsi::where('id', $this->provinsi_id)->first();

        return [
            'kabupaten_id' => $this->id,
            'name' => $this->name,
            'provinsi' => new CompactProvinsiResource($provinsi)
        ];
    }
}
