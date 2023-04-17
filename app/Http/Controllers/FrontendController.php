<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function homepage()
    {
        $plans = config('stripe.plans');
        return view('frontend.index')->with(['plans' => $plans]);
    }

}
