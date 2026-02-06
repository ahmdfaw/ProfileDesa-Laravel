<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Official;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'news' => News::count(),
            'officials' => Official::count(),
            'services' => Service::count(),
            'galleries' => Gallery::count(),
            'contacts' => Contact::where('is_read', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
