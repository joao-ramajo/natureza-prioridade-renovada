<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Suport\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
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
        //    FORTIFY RESPONSABILITY
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
                'name' => 'required|string|max:60',
                'email' => 'required|string|max:60|',
            ]
        );

        $id = Crypt::decrypt($id);

        $user = User::findOrFail($id);

        $emailHasExists = User::where('email', $request->input('email'));

        if ($emailHasExists) {
            return back()
                ->with('error', 'Desculpe, este email não está dentro de nossas diretrizes');
        } 

    
        // update user data
        $user->email = $request->input('email');
        $user->name = $request->input('name');

        $user->save();

        FacadesAuth::setUser($user);

        return back()
            ->with('success', 'Dados alterados com sucesso');
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
