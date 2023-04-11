<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function dashboard(): \Inertia\Response
    {

        $top_templates = Template::where('status', 1)
            ->select('uuid', 'name', 'key', 'description', 'icon', 'category_id')
            ->limit(4)
            ->get();

        return Inertia::render('Dashboard', ['templates' => $top_templates]);
    }
}
