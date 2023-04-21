<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MetaData;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{

    public function home()
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

        $title = "AI Content Writer";
        $description = "Transform your writing process with our AI copywriting platform. Produce captivating content across diverse formats with the best AI writer.";

        $meta = new MetaData();
        $meta->setTitle($title);
        $meta->setDescription($description);

        return view('frontend.index')->with([
            'plans' => $plans, 'templates' => $templates,
            'categories' => $categories,
            'meta' => $meta
        ]);
    }

    public function privacy()
    {
        $title = "Privacy Policy";

        $meta = new MetaData();
        $meta->setTitle($title);

        return view('frontend.pages.privacy')
            ->with(['meta' =>$meta]);
    }

    public function terms()
    {
        $title = "Terms of Service";

        $meta = new MetaData();
        $meta->setTitle($title);

        return view('frontend.pages.terms')
            ->with(['meta' =>$meta]);
    }

    public function contact()
    {
        $title = "Contact us";

        $meta = new MetaData();
        $meta->setTitle($title);

        return view('frontend.pages.contact')
            ->with(['meta' =>$meta]);
    }




}
