<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class EpisodeResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'downloadurl' => $this->downloadurl,
            'title' => $this->title,
            'description' => $this->description,
            'episodenumber' => $this->episodenumber,
            'average_rating' => $this->averageRating(),
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'user' => $this->user,
            'ratings' => $this->ratings,
        ];
    }
}
