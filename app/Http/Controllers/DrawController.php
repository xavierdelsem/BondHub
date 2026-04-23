<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use App\Models\Draw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->is_admin) {

            $draws = Auth::user()->draws()->latest()->paginate(10);

            return view('bonds.draw', compact('draws'))
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }

        return redirect('login');
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
        $validated = $request->validate([
            'drawNumber' => 'required|integer|digits:7',
            'prizePosition' => 'required|integer|in:1,2,3,4,5',
            'drawDate' => 'nullable|date',
        ]);

        // Ensure drawDate is set if not provided by the form (e.g. if field was disabled)
        $validated['drawDate'] ??= now()->format('Y-m-d');

        Auth::user()->draws()->create($validated);

        (new Bond)->updateStatus();

        return redirect()->route('draws.index')->with('success', 'Bond Published successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(Draw $draw)
    {
        $draw->delete();

        return redirect()->route('draws.index')
            ->with('success', 'Record deleted successfully');
    }
}
