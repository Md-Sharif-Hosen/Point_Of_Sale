<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    //
    public function DashboardPage():view
    {
        return view('pages.dashboard.dashboard-page');
    }
}
