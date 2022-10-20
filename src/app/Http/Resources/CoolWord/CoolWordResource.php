<?php

namespace App\Http\Resources\CoolWord;

use Illuminate\Http\Resources\Json\JsonResource;

class CoolWordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request = null)
    {
        return [
            'id' => $this->id()->value,
            'name' => $this->name()->value,
            'views' => $this->views(),
            'description' => $this->description()
        ];
    }
}
