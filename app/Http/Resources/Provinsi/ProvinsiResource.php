<?php

namespace App\Http\Resources\Provinsi;

use App\Http\Resources\Kabupaten\CompactKabupatenResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvinsiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $kabupaten_list = CompactKabupatenResource::collection($this->kabupaten);

        return [
            'provinsi_id' => $this->id,
            'name' => $this->name,
            'list_kabupaten' => $kabupaten_list,
        ];
    }
}
