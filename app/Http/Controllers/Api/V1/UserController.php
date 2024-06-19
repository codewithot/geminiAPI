<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CompleteProfileRequest;


class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }
    public function show(User $user)
    {
        return new UserResource($user);
    }
    public function update(CompleteProfileRequest $request, User $user)
    {
        $user->update($request->all());

        $response = [
            'message' => 'Admin updated successfully' ,
            'user' => new UserResource($user),
        ];

        return response()->json($response, 200);
    }
}
