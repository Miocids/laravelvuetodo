<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (is_null($this->resource) || is_bool($this->resource)) return [];

        return [
            "id"            => $this->resource?->getkey(),
            "title"         => $this->resource?->title,
            "description"   => $this->resource?->description,
            "tags"          => implode(", ", json_decode($this->resource?->tags,true)),
            "created_at"    => $this->resource?->created_at->diffForHumans(),
            "updated_at"    => $this->resource?->updated_at->toDateTimeString(),
        ];
    }
}
