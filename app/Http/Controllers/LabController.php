<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index()
    {
        $labs = Lab::all();
        return view('labs.index', compact('labs'));
    }

    public function create()
    {
        return view('labs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Lab::create($request->all());
        return redirect()->route('labs.index')->with('success', 'Lab successfully added.');
    }

    public function edit(Lab $lab)
    {
        return view('labs.edit', compact('lab'));
    }

    public function update(Request $request, Lab $lab)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $lab->update($request->all());
        return redirect()->route('labs.index')->with('success', 'Lab successfully updated.');
    }

    public function destroy(Lab $lab)
    {
        $lab->delete();
        return redirect()->route('labs.index')->with('success', 'Lab successfully deleted.');
    }
}
