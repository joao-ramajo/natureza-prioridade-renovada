<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionPoint\StoreRequest;
use App\Models\CollectionPoint;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CollectionPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CollectionPoint::all()->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // create model data
        $point = new CollectionPoint();

        $point->name = $request->input('name');
        // format cep
        $point->cep = str_replace('-', '', $request->input('cep'));
        $point->user_id = $request->input('user_id');
        $point->category_id = $request->input('category_id');
        try {
            $point->save();

            return response()->json(CollectionPoint::find($point->id), 201);
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return response()->json(['message' => 'Já existe um ponto de coleta com estas informações'], 409);
            }

            return response()->json(['message' => 'Erro ao salvar registro no banco de dados']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
