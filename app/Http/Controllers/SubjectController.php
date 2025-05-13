<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return SubjectResource::collection(Subject::all());
    }
    /**
     * @param SubjectRequest $request
     * @return SubjectResource
     * Save a new Subject
     */
    public function store(SubjectRequest $request)
    {
        return new SubjectResource(Subject::create($request->all()));
    }

    /**
     * @param Subject $Subject
     * @return SubjectResource
     * Show a Subject
     */
    public function show(Subject $Subject)
    {
        return new SubjectResource($Subject);
    }

    /**
     * @param SubjectRequest $request
     * @param Subject $Subject
     * @return SubjectResource
     * Update a Subject
     */
    public function update(SubjectRequest $request, Subject $Subject)
    {
        $Subject->update($request->except(['password']));
        return new SubjectResource($Subject);
    }

    /**
     * @param Subject $Subject
     * @return \Illuminate\Http\JsonResponse
     * Delete a Subject
     */
    public function destroy(Subject $Subject)
    {
        $Subject->delete();

        return response()->json();
    }
}
