<?php

namespace App\Http\Resources\CoolWord;

use App\Http\Resources\Tag\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Main\Domain\CoolWord\CoolWord;

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
        /** @var CoolWord $this */
        return [
            'id' => $this->id()->value,
            'name' => $this->name()->value,
            'views' => $this->views(),
            'description' => $this->description(),
            'tags' => TagResource::collection($this->tags()->all())->map->toArray()->all()
        ];
    }
}
