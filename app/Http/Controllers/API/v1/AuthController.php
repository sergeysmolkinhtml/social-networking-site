<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

enum ROLES: int
{
    case  ROLE_ADMINISTRATOR = 1;
    case  ROLE_USER = 2;
    case  ROLE_OWNER = 3;
}

class AuthController
{

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['required'],
            'role_id' => ['required', Rule::in(Role::ROLE_OWNER, Role::ROLE_USER)],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gender' => $request->gender,
            'role_id' => $request->role_id,
        ]);


        return response()->json([
            'access_token' => $user->createToken('client')->plainTextToken,
        ]);
    }
}
