<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\VillageProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $profile = VillageProfile::first();

        return view('contact.index', compact('profile'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}
