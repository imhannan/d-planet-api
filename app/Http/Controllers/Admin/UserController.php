<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return UserResource::collection($users);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $data['role_id'] = 2;

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->noContent();
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', Rules\Password::defaults()],
        ]);

        $data['role_id'] = 2;

        $user->update($data);

        return response()->noContent();
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->email === $request->user()->email) {
            return response()->json(['message' => 'you are not allowed to perform this request'], 400);
        }
        $user->delete();
        return response()->noContent();
    }
}
