<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(): View
    {
        $programs = Program::orderBy('order')->paginate(10);

        return view('admin.programs.index', compact('programs'));
    }

    public function create(): View
    {
        return view('admin.programs.create');
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
            $validated['icon'] = $request->file('icon')->store('programs', 'public');
        }

        Program::create($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program kegiatan berhasil ditambahkan!');
    }

    public function edit(Program $program): View
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program): RedirectResponse
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
            if ($program->icon) {
                Storage::disk('public')->delete($program->icon);
            }
            $validated['icon'] = $request->file('icon')->store('programs', 'public');
        }

        $program->update($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program kegiatan berhasil diperbarui!');
    }

    public function destroy(Program $program): RedirectResponse
    {
        if ($program->icon) {
            Storage::disk('public')->delete($program->icon);
        }

        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'Program kegiatan berhasil dihapus!');
    }
}
