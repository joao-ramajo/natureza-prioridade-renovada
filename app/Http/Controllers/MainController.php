<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\CollectionPointController;

class MainController extends Controller
{
    public function index(): View
    {
        $point = new CollectionPointController;

        $data = $point->index();

        return view('home', ['data' => $data]);
    }

    public function collectionPoint(): View {
        return view('collectionPoint.index');
    }
}
