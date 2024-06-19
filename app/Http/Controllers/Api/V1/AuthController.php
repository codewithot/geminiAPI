<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompleteProfileRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(SignupRequest $request): JsonResponse
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $level = $request->input('level');

        var_dump($name);
        var_dump($email);
        var_dump($level);

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'level'=> $level
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->save();

//        Mail::to($user->email)->queue(new SignupMail($user));

        $response = [
            'message' => 'Admin registered successfully' ,
            'user' => new UserResource($user),
            'token' => $token,
        ];

        return response()->json($response, 200);
    }
    

    public function login(Request $request): JsonResponse
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required|string|min:6',
                ]
            );

            if($validateUser->fails()){
                return response()->json([
                    'status'=> false,
                    'message'=> 'Validation error, enter required inputs',
                    'errors'=> $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only('email', 'password'))){
                return response()->json([
                    'status'=> false,
                    'message'=> 'Email and password does not match our records'
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;
            $user->save();

            $response = [
                'message' => 'Admin logged in successfully' ,
                'user' => $user,
                'token' => $token,
            ];

            return response()->json($response, 200);

        } catch (\Throwable $th){
            return response()->json([
                'status'=> false,
                'message'=> $th->getMessage()
            ], 500);
        }
    }
}
