<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\News;
use App\Models\Program;
use App\Models\VillageProfile;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $profile = VillageProfile::first();
        $latestNews = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
        $programs = Program::orderBy('order')->limit(6)->get();
        $galleries = Gallery::orderBy('order')->limit(6)->get();

        return view('home', compact('profile', 'latestNews', 'programs', 'galleries'));
    }
}
