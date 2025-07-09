<?php

namespace App\Services;

use App\Models\CollectionPoint;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class CollectionPointService
{
    public function timeInputIsNotValid($input_1, $input_2): bool
    {
        if (strtotime($input_1) >= strtotime($input_2)) {
            return true;
        } else {
            return false;
        }
    }

    public function findCollectionPointById($id): ?CollectionPoint
    {
        try {
            return CollectionPoint::findOrFail($id);
        } catch (Exception $e) {
            return null;
        }
    }

    public function verifyIfUserCreateThePoint($user_id, $user_point_id): bool
    {
        if ($user_id == $user_point_id) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllWithSearchIndex(Request $request): LengthAwarePaginator
    {
        try {
            $query = CollectionPoint::query();

            if ($request->filled('category')) {
                $categoryId = $request->input('category');

                $query->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('categories.id', $categoryId);
                });
            }

            $points = $query->paginate(10)->withQueryString();

            return $points;
        } catch (Exception $e) {
            Log::channel('npr')->error("Erro ao buscar categorias para esquema de buscas", ['exception' => $e->getMessage()]);
            session()->flash('server_error', 'Houve um erro ao buscar os pontos de coleta, por favor tente novamente mais tarde');
            return new LengthAwarePaginator([], 0, 10);
        }
    }
}
