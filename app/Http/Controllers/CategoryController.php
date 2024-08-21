<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CategoryPage()
    {
        //function_body
        return view('pages.dashboard.category-page');
    }
}
