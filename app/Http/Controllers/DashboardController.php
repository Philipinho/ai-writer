<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{

    public function dashboard(): \Inertia\Response
    {
        return Inertia::render('Dashboard');
    }
}
