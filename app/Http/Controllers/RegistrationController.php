<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\RegistrationResource;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        return RegistrationResource::collection(Registration::all());
    }
    /**
     * @param RegistrationRequest $request
     * @return RegistrationResource
     * Save a new Registration
     */
    public function store(RegistrationRequest $request)
    {
        return new RegistrationResource(Registration::create($request->all()));
    }

    /**
     * @param Registration $Registration
     * @return RegistrationResource
     * Show a Registration
     */
    public function show(Registration $Registration)
    {
        return new RegistrationResource($Registration);
    }

    /**
     * @param RegistrationRequest $request
     * @param Registration $Registration
     * @return RegistrationResource
     * Update a Registration
     */
    public function update(RegistrationRequest $request, Registration $Registration)
    {
        $Registration->update($request->except(['password']));
        return new RegistrationResource($Registration);
    }

    /**
     * @param Registration $Registration
     * @return \Illuminate\Http\JsonResponse
     * Delete a Registration
     */
    public function destroy(Registration $Registration)
    {
        $Registration->delete();

        return response()->json();
    }
}
