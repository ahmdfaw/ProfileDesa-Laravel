<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $query = Gallery::query()->orderBy('order');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $galleries = $query->paginate(12);
        $categories = Gallery::distinct()->pluck('category');

        return view('gallery.index', compact('galleries', 'categories'));
    }
}
