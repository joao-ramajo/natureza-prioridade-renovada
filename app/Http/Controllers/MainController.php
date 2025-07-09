<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\CategoryService;
use App\Services\CollectionPointService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{

    protected CollectionPointService $collectionPointService;
    protected UserService $userService;
    protected CategoryService $categoryService;

    public function __construct(CollectionPointService $cps, UserService $us, CategoryService $cs)
    {
        $this->collectionPointService = $cps;
        $this->userService = $us;
        $this->categoryService = $cs;
    }

    public function index(Request $request): View
    {
        $points = $this->collectionPointService->getAllWithSearchIndex($request);

        $categories = $this->categoryService->getAllCategoriesWithPointExists();

        return view('home', [
            'points' => $points,
            'categories' => $categories
        ]);
    }

    public function collectionPoint(): View
    {

        $categories = $this->categoryService->getAllCategories();

        return view('collectionPoint.index', ['categories' => $categories]);
    }

    public function map(): View
    {
        return view('map');
    }

    public function view($id): View | RedirectResponse
    {
        $id = Crypt::decrypt($id);
        $point = $this->collectionPointService->findCollectionPointById($id);
        if (!$point) {
            return back()
                ->with('error', 'Não encontramos nenhuma informação');
        }
        $categories = $this->categoryService->getAllCategories();
        return view('collectionPoint.view', ['point' => $point, 'categories' => $categories]);
    }

    public function profile($id): View | RedirectResponse
    {
        $id = Crypt::decrypt($id);

        if ($id === null || $id != Auth::user()->id) {
            return back()->with('error', 'Conta não encontrada');
        }

        $user = Auth::user();

        return view('auth.profile', ['user' => $user]);
    }
}
