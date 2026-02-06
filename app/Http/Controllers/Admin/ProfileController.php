<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VillageProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $profile = VillageProfile::firstOrFail();

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request): RedirectResponse
    {
        $profile = VillageProfile::firstOrFail();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'history' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'mission' => ['nullable', 'string'],
            'geographic_location' => ['nullable', 'string'],
            'area' => ['nullable', 'string', 'max:255'],
            'population' => ['nullable', 'integer', 'min:0'],
            'districts' => ['nullable', 'integer', 'min:0'],
            'village_head' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'logo' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($request->hasFile('logo')) {
            if ($profile->logo) {
                Storage::disk('public')->delete($profile->logo);
            }
            $validated['logo'] = $request->file('logo')->store('profile', 'public');
        }

        $profile->update($validated);

        return redirect()->route('admin.profile.edit')->with('success', 'Profil desa berhasil diperbarui!');
    }
}
