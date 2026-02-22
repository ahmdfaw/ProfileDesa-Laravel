<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(): View
    {
        $programs = Program::orderBy('order')->get();

        return view('programs.index', compact('programs'));
    }

    public function show(int $id): View
    {
        $program = Program::findOrFail($id);

        return view('programs.show', compact('program'));
    }
}
