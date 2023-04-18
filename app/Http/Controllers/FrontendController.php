<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{

    public function homepage()
    {
        $plans = config('stripe.plans');

        $templates = Cache::remember('templates', Carbon::now()->addHour(), function () {
            return Template::where('status', 1)
                ->with('categories:id,name')
                ->limit(8)
                ->get();
        });

        $categories = Cache::remember('categories', Carbon::now()->addHour(), function () {
            return Category::has('templates')->get();
        });

        return view('frontend.index')->with([
            'plans' => $plans, 'templates' => $templates,
            'categories' => $categories
        ]);
    }

}
