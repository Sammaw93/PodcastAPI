<?php

namespace App\Http\Controllers;

use App\Episode;
use Illuminate\Http\Request;
use App\Http\Resources\EpisodeResource;

class EpisodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of episodes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EpisodeResource::collection(Episode::with('ratings')->paginate(25));
    }

    /**
     * Store a newly created episode in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $episode = episode::create([
            'user_id' => auth()->user()->id,
            'id' => $request->id,
            'downloadurl' => $request->downloadurl,
            'title' => $request->title,
            'description' => $request->description,
            'episodenumber' => $request->episodenumber,

          $path =Storage::disk('do-spaces')->putFileAs('episodes',
          $request->file('uploaded_file'), time().'.'.$extension);

        ]);

        return new EpisodeResource($episode);
    }

    /**
     * Display the specified episode.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        return new EpisodeResource($episode);
    }

    /**
     * Update the specified episode in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Episode $episode)
    {
        // check if currently authenticated user is the owner of the episode
        if (auth()->user()->id !== $episode->user_id) {
            return response()->json(['error' => 'You can only edit your own episodes.'], 403);
        }

        $episode->update($request->only(['title', 'description', 'episodenumber']));

        return new EpisodeResource($episode);
    }

    /**
     * Remove the specified episode from storage.
     *
     * @param App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Episode $episode)
    {
        $episode->delete();

        return response()->json(null, 204);
    }
}
