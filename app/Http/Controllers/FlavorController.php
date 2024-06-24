<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flavor;

class FlavorController extends Controller
{
    public function index()
    {
        $flavors = Flavor::all();
        return view('flavors.index', compact('flavors'));
    }

    public function create()
    {
        return view('flavors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Flavor::create($request->all());

        return redirect()->route('flavors.index')->with('success', 'Flavor added successfully');
    }

    public function destroy($id)
    {
        $flavor = Flavor::findOrFail($id);
        $flavor->delete();

        return redirect()->route('flavors.index')->with('success', 'Flavor deleted successfully');
    }
}