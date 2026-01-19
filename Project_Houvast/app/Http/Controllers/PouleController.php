<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poule;

class PouleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $poules = Poule::when($query, function ($q) use ($query) {
            $q->where('poule_name', 'like', '%' . $query . '%')
              ->orWhere('location', 'like', '%' . $query . '%');
        })->get();
        return view('poules.index', compact('poules', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
public function show(\App\Models\Poule $poule)
{
    // $contestants = $poule->contestants()->orderBy('name')->get();

    // return view('poules.show', compact('poule', 'contestants'));
    return view('poules.pouleView', compact('poule'));


}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $query = Poule::findOrFail($id);
        $query->delete();
        return redirect()->route('poule')->with('success', 'Poule deleted successfully.');
    }
}
