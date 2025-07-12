<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\CategoryService;
use App\Services\CollectionPointService;
use App\Services\Operations;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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

        $categories = Cache::remember('all_categories_with_exists_point', 360000, function() {
            return $this->categoryService->getAllCategoriesWithPointExists();
        });

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
        $id = Operations::decryptId($id);

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
        $id = Operations::decryptId($id);

        if ($id === null || $id != Auth::user()->id) {
            return redirect()
                ->route('home')
                ->with('server_error', 'Conta não encontrada');
        }

        $user = Auth::user();

        return view('auth.profile', ['user' => $user]);
    }
}
