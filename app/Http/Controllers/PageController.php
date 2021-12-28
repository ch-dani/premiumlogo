<?php

namespace App\Http\Controllers;

use App\Helpers\Translate;
use App\Models\Page;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function home(Request $request)
    {
        return view('site.home');
    }

    public function page(Request $request)
    {
    	$Page = Page::where('status', 'published')->where('slug', Translate::getClearRequestPath($request))->firstOrFail();

        return view('site.page', compact('Page'));
    }

    public function aboutUs(Request $request)
    {
    	$Page = Page::where('status', 'published')->where('slug', Translate::getClearRequestPath($request))->first();

        return view('site.about-us', compact('Page'));
    }

    public function testimonials()
    {
    	$Testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(10);

        return view('site.testimonials', compact('Testimonials'));
    }
}
