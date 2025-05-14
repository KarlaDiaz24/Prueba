<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return new UserResource(User::create($data));
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
        $data = $request->validated();

        if (!empty($data['password'])) {
        if (!Hash::info($data['password'])['algoName']) {
            $data['password'] = Hash::make($data['password']);
        }
        } else {
            unset($data['password']);
        }
        $user->update($data);

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
