<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BondController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $bonds = Auth::user()->bonds()->latest()->paginate(10);

            return view('index', compact('bonds'))
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }

        return redirect('login');

    }

    public function create()
    {
        return view('bonds.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bondNumber' => 'required|integer|digits:7',
            'bondSeries' => 'required|string',
            'buying_date' => 'nullable|date',
        ]);

        Auth::user()->bonds()->create($request->all());

        return redirect()->route('bonds.index')
            ->with('success', 'Bond Inserted successfully.');
    }

    public function show(Bond $bond)
    {
        //
    }

    public function edit(Bond $bond)
    {
        return view('bonds.edit', compact('bond'));
    }

    public function update(Request $request, Bond $bond)
    {
        $request->validate([
            'bondNumber' => 'required|integer',
            'bondSeries' => 'required|string',
            'buying_date' => 'nullable|date',
        ]);

        $bond->update($request->all());
        $updated = $bond->updateStatus();

        return redirect()->route('bonds.index')
            ->with('success', $updated);
    }

    public function destroy(Bond $bond)
    {
        $bond->delete();

        return redirect()->route('bonds.index')
            ->with('success', 'Bond deleted successfully');
    }
}
