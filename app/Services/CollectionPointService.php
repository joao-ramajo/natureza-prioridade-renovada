<?php

namespace App\Services;

use App\Models\CollectionPoint;

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
}
