<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\CollectionPointController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\CollectionPoint;

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

        $category = new CategoryController;
        $categories = $category->index();

        return view('collectionPoint.index', ['categories' => $categories]);
    }
}
