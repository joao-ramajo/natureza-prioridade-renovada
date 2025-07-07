<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\CollectionPointController;
use App\Http\Controllers\CategoryController;

class MainController extends Controller
{
    public function index(): View
    {
        $point = new CollectionPointController;
        $data = $point->index();


        return view('home', ['data' => $data]);
    }

    public function collectionPoint(): View
    {

        $category = new CategoryController;
        $categories = $category->index();

        return view('collectionPoint.index', ['categories' => $categories]);
    }
}
