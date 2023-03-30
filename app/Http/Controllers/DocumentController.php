<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DocumentController extends Controller
{
    public function show(): \Inertia\Response
    {
        return Inertia::render('Documents/Show');
    }

}
