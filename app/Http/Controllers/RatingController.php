<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Http\Resources\RatingResource;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        return RatingResource::collection(Rating::all());
    }
    /**
     * @param RatingRequest $request
     * @return RatingResource
     * Save a new Rating
     */
    public function store(RatingRequest $request)
    {
        return new RatingResource(Rating::create($request->all()));
    }

    /**
     * @param Rating $Rating
     * @return RatingResource
     * Show a Rating
     */
    public function show(Rating $Rating)
    {
        return new RatingResource($Rating);
    }

    /**
     * @param RatingRequest $request
     * @param Rating $Rating
     * @return RatingResource
     * Update a Rating
     */
    public function update(RatingRequest $request, Rating $Rating)
    {
        $Rating->update($request->except(['password']));
        return new RatingResource($Rating);
    }

    /**
     * @param Rating $Rating
     * @return \Illuminate\Http\JsonResponse
     * Delete a Rating
     */
    public function destroy(Rating $Rating)
    {
        $Rating->delete();

        return response()->json();
    }
}
