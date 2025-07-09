<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\CategoryService;
use App\Services\CollectionPointService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index(Request $request, CollectionPointService $collectionPointService, CategoryService $categoryService): View
    {
        $points = $collectionPointService->getAllWithSearchIndex($request);

        $categories = $categoryService->getAllCategoriesWithPointExists();

        return view('home', [
            'points' => $points,
            'categories' => $categories
        ]);
    }

    public function collectionPoint(CategoryService $service): View
    {

        $categories = $service->getAllCategories();

        return view('collectionPoint.index', ['categories' => $categories]);
    }

    public function map(): View
    {
        return view('map');
    }

    public function view($id, CollectionPointService $collectionPointService, CategoryService $categoryService): View | RedirectResponse
    {

        $id = Crypt::decrypt($id);
        $point = $collectionPointService->findCollectionPointById($id);
        if (!$point) {
            return back()
                ->with('error', 'Não encontramos nenhuma informação');
        }
        $categories = $categoryService->getAllCategories();
        return view('collectionPoint.view', ['point' => $point, 'categories' => $categories]);
    }

    public function profile($id): View | RedirectResponse
    {
        $id = Crypt::decrypt($id);
        if ($id != Auth::user()->id) {
            return back()->with('error', 'Conta não encontrada');
        }

        $user = Auth::user();

        return view('auth.profile', ['user' => $user]);
    }
}
