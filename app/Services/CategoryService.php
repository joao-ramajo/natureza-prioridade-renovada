<?php

namespace App\Services;

use App\Models\Category;
use App\Models\CollectionPoint;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    public function getAllCategoriesWithPointExists(): Collection
    {
        try {
            return Category::has('collectionPoints')->get();
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao buscar pontos de coleta e categorias', ['exception' => $e->getMessage()]);
            return new Collection();
        }
    }

    public function getAllCategories(): Collection
    {
        try {
            return Category::all();
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao buscar categorias', ['exception' => $e->getMessage()]);
            session()->flash('server_error', 'Erro ao buscar categorias, por favor tente novamente mais tarde');
            return new Collection();
        }
    }
}
