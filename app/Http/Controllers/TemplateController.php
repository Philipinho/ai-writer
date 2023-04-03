<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TemplateController extends Controller
{

    public function index()
    {
        $templates = Template::where('status', 1)
            ->select('uuid', 'name', 'key', 'description', 'icon', 'category_id')
            ->get();

        return Inertia::render('Templates/Index', ['templates' => $templates]);
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
