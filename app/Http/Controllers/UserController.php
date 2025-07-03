<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate(
            [
                'username' => 'required|max:30|string',
                'email' => 'required|email|unique:users|max:40|string',
                'password' => 'required|min:6|max:12',
                'name' => 'required|max:60',
            ]
        );

        // create user object
        $user = new User();
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));

        // store user data
        $user->save();

        // return user data
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate request
        $request->validate(
            [
                'name' => 'required',
                'username' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]
        );

        // find user by id
        $user = User::findOrFail($id);

        // update user data
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));

        // save new user data 
        $user->save();

        // return new data
        return response()->json([
            'message' => 'Dados atualizados com sucesso',
            'user' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso'], 200);
    }
}
