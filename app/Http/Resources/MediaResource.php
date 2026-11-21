<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'title'    => $this->title,
            'type'     => $this->type,
            'year'     => $this->year,
            'score'    => $this->score,
            'genres'   => $this->genres,
            'episodes' => $this->when($this->type === 'anime', $this->episodes),
            'chapters' => $this->when($this->type === 'manga', $this->chapters),
            // hanya muncul kalau relasi users sudah di-load
            'users'    => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
