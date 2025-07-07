<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\CollectionPointController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\CollectionPoint;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index(Request $request): View
    {
        $query = CollectionPoint::query();

        if ($request->filled('category')) {
            $categoryId = $request->input('category');

            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        $points = $query->paginate(10)->withQueryString();
        $categories = Category::has('collectionPoints')->get();


        return view('home', [
            'points' => $points,
            'categories' => $categories
        ]);
    }

    public function collectionPoint(): View
    {

        $categories = Category::all();

        return view('collectionPoint.index', ['categories' => $categories]);
    }

    public function map(): View
    {
        return view('map');
    }

    public function view($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $point = CollectionPoint::findOrFail($id);
            $category = new CategoryController;
            $categories = $category->index();

            return view('collectionPoint.view', ['point' => $point, 'categories' => $categories]);
        } catch (Exception $e) {
            return back()
                ->with('error', 'Não encontramos nenhuma informação');
        }
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
