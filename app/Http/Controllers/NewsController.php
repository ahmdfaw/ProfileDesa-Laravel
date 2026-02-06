<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('news.index', compact('news'));
    }

    public function show(string $slug): View
    {
        $news = News::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $news->increment('views');

        $relatedNews = News::where('is_published', true)
            ->where('id', '!=', $news->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}
