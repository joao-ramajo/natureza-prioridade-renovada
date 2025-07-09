<?php

namespace App\Services;

use App\Models\CollectionPoint;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CollectionPointService
{
    public function timeInputIsNotValid($input_1, $input_2)
    {
        if (strtotime($input_1) >= strtotime($input_2)) {
            return true;
        } else {
            return false;
        }
    }

    public function findCollectionPointById($id)
    {
        return CollectionPoint::findOrFail($id);
    }

    public function verifyIfUserCreateThePoint($user_id, $user_point_id): bool
    {
        if ($user_id == $user_point_id) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllWithSearchIndex(Request $request)
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
            
        }
    }
}
