<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\CategoryService;
use App\Services\CollectionPointService;
use App\Services\Operations;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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

    public function index(): View
    {
        return view('pages.home');
    }

    public function map(): View
    {
        return view('pages.map');
    }

    public function view(string $id): View | RedirectResponse
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

    public function profile(): View | RedirectResponse
    {
        $id = Auth::user()->id;

        if ($id === null) {
            return redirect()
                ->route('home')
                ->with('server_error', 'Conta não encontrada');
        }

        $user = User::with(['collectionPoints',])->where('id', Auth::user()->id)->first();

        return view('auth.profile', ['user' => $user]);
    }

    public function pontos(Request $request): View
    {
        $points = $this->collectionPointService->getAllWithSearchIndex($request);

        $categories = $this->categoryService->getAllCategoriesWithPointExists();

        return view('pages.points', ['points' => $points, 'categories' => $categories]);
    }
}
