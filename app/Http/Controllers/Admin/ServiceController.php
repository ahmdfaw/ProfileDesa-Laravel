<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::orderBy('order')->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'image', 'max:1024'],
            'requirements' => ['nullable', 'string'],
            'procedure' => ['nullable', 'string'],
            'processing_time' => ['nullable', 'string', 'max:255'],
            'cost' => ['nullable', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'image', 'max:1024'],
            'requirements' => ['nullable', 'string'],
            'procedure' => ['nullable', 'string'],
            'processing_time' => ['nullable', 'string', 'max:255'],
            'cost' => ['nullable', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('icon')) {
            if ($service->icon) {
                Storage::disk('public')->delete($service->icon);
            }
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy(Service $service): RedirectResponse
    {
        if ($service->icon) {
            Storage::disk('public')->delete($service->icon);
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
