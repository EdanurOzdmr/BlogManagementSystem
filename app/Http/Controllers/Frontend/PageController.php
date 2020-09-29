<?php

namespace App\Http\Controllers\Frontend;

use App\Pages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function detail($slug){
        $pageList=Pages::all()->sortBy('page_must');
        $page=Pages::where('page_slug', $slug)->first();
        return view('frontend.page.detail', compact('page', 'pageList'));
    }
}
