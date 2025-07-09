<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use App\Services\Operations;
use App\Services\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    public function update(StoreRequest $request, string $id): RedirectResponse
    {
        $id = Operations::decryptId($id);

        if ($id === null) {
            return back()
                ->with('error', 'Desculpe houve um erro ao atualizar seu perfil, tente novamente');
        }

        $user = $this->userService->findUserById($id);

        if (!$user) {
            return back()
                ->with('error', 'Desculpe houve um erro ao atualizar suas informações, tente novamente ou entre em contato com o suporte');
        }

        $emailHasExists = $this->userService->verifyIfEmailExists($request->input('email'));


        if (empty($emailHasExists)) {
            return back()
                ->with('server_error', 'Desculpe, não foi possivel fazer está operação, nenhuma alteração realizada.');
        }


        if ($emailHasExists) {
            $email_user = $this->userService->findUserByEmail($request->input('email'));

            if (empty($email_user)) {
                return back()
                    ->with('error', 'Desculpe, este email não está dentro de nossas diretrizes de nossas permissões');
            }
            if ($email_user->id != $id) {
                return back()
                    ->with('error', 'Desculpe, este email não está dentro de nossas diretrizes');
            }
        }

        // update user data
        $user->email = $request->input('email');
        $user->name = $request->input('name');

        try {
            $user->save();
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao atualizar informações do usuário', ['exception' => $e->getMessage()]);
            return back()
                ->with('error_server', 'Aconteceu algo inesperado ao tentar atualizar as informações, tente novamente mais tarde');
        }

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
            $id = Operations::decryptId($id);

            if ($id === null) {
                return back()
                    ->with('server_error', 'Desculpe houve um erro ao atualizar seu perfil, tente novamente');
            }

            // $user = User::findOrFail($id);
            $user = $this->userService->findUserById($id);
            $user->delete();

            FacadesAuth::logout();
            session()->invalidate();
            session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('success', 'Conta apagada com sucesso');
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao apagar usuário', ['exception' => $e->getMessage()]);
            return back()
                ->with('error', 'Desculpe, houve um erro ao apagar sua conta. Tente novamente mais tarde');
        }
    }
}
