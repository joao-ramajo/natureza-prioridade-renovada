<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionPoint\StoreRequest;
use App\Http\Requests\CollectionPoint\UpdateRequest;
use App\Models\CollectionPoint;
use Database\Seeders\CategoriesTableSeeder;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectionPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CollectionPoint::paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // create model data
        if (strtotime($request->open_from) >= strtotime($request->open_to)) {
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

        $categories_id = $request->input('categories-id', []); // já é um array ou [] por padrão
        
        try {
            $point->save();

            $point->categories()->sync($categories_id);

            return redirect()
                ->route('home')
                ->with('success', 'Ponto de coleta cadastrado com sucesso !');
        } catch (QueryException $e) {
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $point = CollectionPoint::with(['category', 'user'])->findOrFail($id);
            return $point;
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Ponto de coleta não encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Houve um erro ao realizar a busca'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        try {
            // find point in DB
            $point = CollectionPoint::findOrFail($id);

            // verify the request origin
            if ($request->input('user_id') != $point->user_id) {
                return response()->json(['message' => 'Você não tem permissão para está tarefa.'], 403);
            }

            $point->name = $request->input('name');
            // format cep
            $point->cep = str_replace('-', '', $request->input('cep'));
            $point->category_id = $request->input('category_id');

            $point->save();

            return response()->json(
                [
                    'message' => 'Ponto de coleta atualizado com sucesso',
                    'info' => CollectionPoint::find($point->id)->toArray()
                ],
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Registro não encontrado no banco de dados'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Erro ao salvar registro no banco de dados'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $point = CollectionPoint::findOrFail($id);
            $point->delete();
            return response()->json(['message' => 'Ponto de coleta deletado com sucesso'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'O ponto de coleta não foi encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Houve um erro ao apagar o registro'], 500);
        }
    }
}
