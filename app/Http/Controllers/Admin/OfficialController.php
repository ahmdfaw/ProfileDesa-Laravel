<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Official;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OfficialController extends Controller
{
    public function index(): View
    {
        $officials = Official::orderBy('order')->paginate(10);

        return view('admin.officials.index', compact('officials'));
    }

    public function create(): View
    {
        return view('admin.officials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('officials', 'public');
        }

        Official::create($validated);

        return redirect()->route('admin.officials.index')->with('success', 'Pemerintahan berhasil ditambahkan!');
    }

    public function edit(Official $official): View
    {
        return view('admin.officials.edit', compact('official'));
    }

    public function update(Request $request, Official $official): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('photo')) {
            if ($official->photo) {
                Storage::disk('public')->delete($official->photo);
            }
            $validated['photo'] = $request->file('photo')->store('officials', 'public');
        }

        $official->update($validated);

        return redirect()->route('admin.officials.index')->with('success', 'Pemerintahan berhasil diperbarui!');
    }

    public function destroy(Official $official): RedirectResponse
    {
        if ($official->photo) {
            Storage::disk('public')->delete($official->photo);
        }

        $official->delete();

        return redirect()->route('admin.officials.index')->with('success', 'Pemerintahan berhasil dihapus!');
    }
}
