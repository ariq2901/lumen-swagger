<?php

namespace App\Http\Resources\Kabupaten;

use Illuminate\Http\Resources\Json\JsonResource;

class CompactKabupatenResource extends JsonResource
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
            'kabupaten_id' => $this->id,
            'name' => $this->name
        ];
    }
}
