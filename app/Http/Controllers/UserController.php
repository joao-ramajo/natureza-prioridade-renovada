<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    public function update(StoreRequest $request, string $id): RedirectResponse
    {


        $id = Crypt::decrypt($id);
        $user = $this->userService->findUserById($id);

        $emailHasExists = $this->userService->verifyIfEmailExists($request->input('email'));

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
    public function destroy(string $id): RedirectResponse
    {
        try {
            $id = Crypt::decrypt($id);


            // $user = User::findOrFail($id);
            $user = $this->userService->findUserById($id);
            $user->delete();

            FacadesAuth::logout();
            session()->invalidate();
            session()->regenerateToken();

            // return response()->json(['message' => 'Usuário deletado com sucesso'], 200);
            return redirect()
                ->route('login')
                ->with('success', 'Conta apagada com sucesso');
        } catch (Exception $e) {
            return back()
                ->with('error', 'Desculpe, houve um erro ao apagar sua conta. Tente novamente mais tarde');
        }
    }
}
