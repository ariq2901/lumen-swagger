<?php

namespace App\Http\Resources\Provinsi;

use Illuminate\Http\Resources\Json\JsonResource;

class CompactProvinsiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'provinsi_id' => $this->id,
            'name' => $this->name,
        ];
    }
}
