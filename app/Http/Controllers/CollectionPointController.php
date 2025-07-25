<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionPoint\StoreRequest;
use App\Jobs\GetGeoInfoJob;
use App\Models\CollectionPoint;
use App\Policies\CollectionPointPolice;
use App\Services\CategoryService;
use App\Services\CollectionPointService;
use App\Services\Operations;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;


class CollectionPointController extends Controller
{
    protected CollectionPointService $collectionPointService;
    protected CategoryService $categoryService;
    protected CollectionPointPolice $police;
    public function __construct(CollectionPointService $service, CategoryService $cs, CollectionPointPolice $police)
    {
        $this->collectionPointService = $service;
        $this->categoryService = $cs;
        $this->police = $police;
    }

    public function index()
    {
        return CollectionPoint::paginate(5);
    }

    public function create(): RedirectResponse | View
    {

        if (!Gate::allows('viewForm', CollectionPoint::class)) {
            return redirect()
                ->back()
                ->with('error', 'Você não tem permissão para acessar este contéudo');
        }

        $categories = $this->categoryService->getAllCategories();

        return view('collectionPoint.index', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Gate::allows('create', CollectionPoint::class);

        if ($this->collectionPointService->timeInputIsNotValid($request->open_from, $request->open_to)) {
            return back()
                ->withErrors(['open_to' => 'O horário de fechamento deve ser maior que o de abertura.'])
                ->withInput();
        }

        $days_open = implode(' - ', $request->days_open);

        $point = new CollectionPoint();

        $point->name = $request->input('name');
        $point->cep = str_replace('-', '', $request->input('cep'));
        $point->street = $request->street;
        $point->neighborhood = $request->neighborhood;
        $point->city = $request->city;
        $point->state = $request->state;
        $point->complement = $request->complement;


        $point->user_id = $request->input('user_id');
        $point->open_from = $request->input('open_from');
        $point->open_to = $request->input('open_to');
        $point->days_open = $days_open;
        $point->description = $request->input('description');

        $categories_id = $request->input('categories-id', []);

        try {
            $point->save();
            $point->categories()->sync($categories_id);
            $data = $request->only(['cep', 'neighborhood', 'city', 'state', 'street']);
            GetGeoInfoJob::dispatch($this->collectionPointService, $data, $point->id);

            return redirect()
                ->route('home')
                ->with('success', 'Ponto de coleta cadastrado com sucesso !');
        } catch (QueryException $e) {
            Log::channel('npr')->error('Houve um erro ao salvar o ponto de coleta', ['exception' => $e->getMessage()]);
            if ($e->getCode() === '23000') {
                return back()
                    ->withInput()
                    ->with('error', 'Nome do ponto já cadastrado');
            }
            return back()
                ->withInput()
                ->with('error', 'Houve um erro ao salvar as informações, aguarde alguns instantes e tente novamente');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try {

            $id = Crypt::decrypt($id);
            $point = $this->collectionPointService->findCollectionPointById($id);

            if (!Gate::allows('update', $point)) {
                return redirect()
                    ->back()
                    ->with('error', 'Você não pode atualizar as informações deste ponto');
            }

            if ($this->collectionPointService->timeInputIsNotValid($request->open_from, $request->open_to)) {
                return back()
                    ->withErrors(['open_to' => 'O horário de fechamento deve ser maior que o de abertura.'])
                    ->withInput();
            }


            $result = $this->collectionPointService->update($request, $point);

            if ($result) {
                return redirect()
                    ->route('collection_point.view', ['id' => Crypt::encrypt($point->id)])
                    ->with('success', 'Informações atualizadas com sucesso');
            } else {
                return redirect()
                    ->route('collection_point.view', ['id' => Crypt::encrypt($point->id)])
                    ->with('error', 'Não foi posssivel atualizar as informações, tente novamente mais tarde');
            }
        } catch (Exception $e) {
            Log::channel('npr')->error("CollectionPointController@update : {$e->getMessage()}");
            return back()
                ->with('error', 'Desculpe, houve um erro ao atualizar o registro, tente novamente mais tarde.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            Gate::authorize('delete', CollectionPoint::class);
            $id = Operations::decryptId($id);
            $point = $this->collectionPointService->findCollectionPointById($id);
            if (Gate::denies('user_can_delete', $point)) {
                abort(403, "Você não tem permissão para acessar este recurso ");
            }
            $point->delete();
            return redirect()
                ->route('home')
                ->with('success', 'Registro apagado com sucesso');
        } catch (Exception $e) {
            return back()
                ->with('error', 'Erro ao apagar registro, tente novamente mais tarde');
        }
    }
}
