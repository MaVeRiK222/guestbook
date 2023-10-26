<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        if (User::where("login", $request->login)->first()) {
            return response()->json([
                'message' => 'Такой пользователь уже есть.'
            ], 404);
            ;
        }
        $created_user = User::create($request->validated());
        return new UserResource($created_user);
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getuser(UserStoreRequest $request)
    {
        if ($request->validated()) {
            $user = User::where('login', $request->login)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                return new UserResource($user);
            }
        }
        return response()->json(['message' => "Данные для входа не верны"], 404);
    }
}
