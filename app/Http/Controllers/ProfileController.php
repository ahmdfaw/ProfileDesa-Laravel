<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\VillageProfile;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $profile = VillageProfile::first();
        $officials = Official::orderBy('order')->get();

        return view('profile', compact('profile', 'officials'));
    }
}
