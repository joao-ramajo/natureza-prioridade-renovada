<?php

namespace App\Services;

use App\Models\CollectionPoint;
use Illuminate\Http\Request;

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
        $query = CollectionPoint::query();

        if ($request->filled('category')) {
            $categoryId = $request->input('category');

            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        $points = $query->paginate(10)->withQueryString();

        return $points;
    }
}
