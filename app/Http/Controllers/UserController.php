<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }
    /**
     * @param UserRequest $request
     * @return UserResource
     * Save a new user
     */
    public function store(UserRequest $request)
    {
        return new UserResource(User::create($request->all()));
    }

    /**
     * @param User $user
     * @return UserResource
     * Show a user
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * @param UserRequest $request
     * @param User $user
     * @return UserResource
     * Update a user
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->except(['password']));
        return new UserResource($user);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * Delete a user
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json();
    }
}
