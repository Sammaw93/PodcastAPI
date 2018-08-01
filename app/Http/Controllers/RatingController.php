<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Rating;
use Illuminate\Http\Request;
use App\Http\Resources\RatingResource;

class RatingController extends Controller
{
    /**
     * Store a newly created rating in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Episode $episode
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Episode $episode)
    {
        $rating = Rating::firstOrCreate(
            [
                'user_id' => auth()->user()->id,
                'id' => $episode->id,
            ],
            ['rating' => $request->rating]
        );

        return new RatingResource($rating);
    }
}
