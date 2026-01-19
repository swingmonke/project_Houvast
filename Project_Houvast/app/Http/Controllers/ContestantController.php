<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contestant;
use Illuminate\Support\Facades\Storage;

class ContestantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->get('query');

        $contestants = Contestant::when($query, function ($q, $query) {
            $q->where(function ($sub) use ($query) {
                $sub->where('first_name', 'like', "%{$query}%")
                    ->orWhere('infix', 'like', "%{$query}%")
                    ->orWhere('last_name', 'like', "%{$query}%");
            });
        })->get();

        if ($request->ajax()) {
            return view('contestants._list', compact('contestants'));
        }

        return view('contestants.index', compact('contestants'));
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
    public function show(Contestant $contestant)
    {
        return view('contestants.show', compact('contestant'));
    }

    /**
     * Toggle presence for a contestant (present / not present)
     */
    public function togglePresent(Request $request, Contestant $contestant)
    {
        $contestant->is_present = !$contestant->is_present;
        $contestant->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'is_present' => (bool) $contestant->is_present,
                'contestant_id' => $contestant->contestant_id,
            ]);
        }

        return redirect()->back()->with('success', 'Presence updated.');
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
    public function update(Request $request, Contestant $contestant)
    {
        $validated = $request->validate([
            'weight' => ['nullable', 'numeric'],
            'confirm_weight' => ['nullable', 'boolean'],
        ]);

        if (array_key_exists('weight', $validated) && $validated['weight'] !== null) {
            $newWeight = $validated['weight'];
            
            // Get the reference weight (registered_weight if available, otherwise current weight)
            $referenceWeight = $contestant->registered_weight ?? $contestant->weight;
            
            // Check if the new weight differs by more than 10% from the reference weight
            $weightDifference = abs($newWeight - $referenceWeight);
            $percentageDifference = ($weightDifference / $referenceWeight) * 100;
            
            // If difference is more than 10% and not confirmed, return with warning
            $isConfirmed = isset($validated['confirm_weight']) && $validated['confirm_weight'];
            if ($percentageDifference > 10 && $referenceWeight > 0 && !$isConfirmed) {
                return redirect()->back()
                    ->with('weight_warning', "Warning: The entered weight ({$newWeight} kg) differs by " . round($percentageDifference, 1) . "% from the registered weight ({$referenceWeight} kg). Please confirm this is correct.")
                    ->with('weight_warning_data', [
                        'new_weight' => $newWeight,
                        'reference_weight' => $referenceWeight,
                        'percentage_difference' => $percentageDifference,
                    ])
                    ->withInput();
            }
            
            $contestant->weight = $newWeight;
            $contestant->is_weighed = true;
        }

        $contestant->save();

        return redirect()->back()->with('success', 'Contestant updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contestant $contestant)
    {
        $contestant->delete();

        return redirect()->route('Contestants_list')->with('success', 'Contestant deleted.');
    }
}
