<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionPoint\StoreRequest;
use App\Http\Requests\CollectionPoint\UpdateRequest;
use App\Models\CollectionPoint;
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
        return CollectionPoint::paginate(1);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // create model data

        dd($request);
        $point = new CollectionPoint();

        $point->name = $request->input('name');
        // format cep
        $point->cep = str_replace('-', '', $request->input('cep'));
        $point->user_id = $request->input('user_id');
        $point->open_from = $request->input('open_from');
        $point->open_to = $request->input('open_to');
        $point->days_open = $request->input('days_open');
        $point->description = $request->input('description');

        $categories_id = $request->input('categories_id');


        try {
            $point->save();

            $point->categories()->sync($categories_id);

            return response()->json(
                [
                    'message' => 'Ponto de coleta criado com sucesso',
                    'info' => CollectionPoint::with(['categories', 'user'])->find($point->id)->toArray()
                ],
                201
            );
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return response()->json(['message' => 'Já existe um ponto de coleta com estas informações'], 409);
            }

            return response()->json(['message' => 'Erro ao salvar registro no banco de dados', 'erro' => $e->getMessage()], 500);
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
