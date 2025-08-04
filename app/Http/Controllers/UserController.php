<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    public function update(UpdateRequest $request): RedirectResponse
    {
        $id = Auth::user()->id;

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


        if (!$emailHasExists) {
            return back()
                ->with('server_error', 'Desculpe, não foi possivel fazer está operação, nenhuma alteração realizada.');
        }


        $email_user = $this->userService->findUserByEmail($request->input('email'));

        if (!$email_user) {
            return back()
                ->with('error', 'Desculpe, este email não está dentro de nossas diretrizes de nossas permissões');
        }
        if ($email_user->id != $id) {
            return back()
                ->with('error', 'Desculpe, este email não está dentro de nossas diretrizes');
        }


        $user->email = $request->input('email');
        $user->name = $request->input('name');

        try {
            $user->save();
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao atualizar informações do usuário', ['exception' => $e->getMessage()]);
            return back()
                ->with('server_error', 'Aconteceu algo inesperado ao tentar atualizar as informações, tente novamente mais tarde');
        }

        Auth::setUser($user);

        return back()
            ->with('success', 'Dados alterados com sucesso');
    }

    public function destroy(): RedirectResponse
    {
        try {
            if (!Auth::user()) {
                throw new InvalidArgumentException('Você deve estar logado para realizar está ação');
            }
            $this->userService->deleteAuthUser();

            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('success', 'Conta apagada com sucesso');
        } catch (InvalidArgumentException $e) {
            return back()
                ->with('error', $e->getMessage());
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao apagar usuário', ['exception' => $e->getMessage()]);
            return back()
                ->with('error', 'Desculpe, houve um erro ao apagar sua conta. Tente novamente mais tarde');
        }
    }
}
