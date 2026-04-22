<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BondController extends Controller
{
    public function index() {
        if(auth()->check()){
            $bonds = Auth::user()->bonds()->latest()->paginate(10);  
            return view('index', compact('bonds'))
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }
        return redirect('login');
        
    }   
    
    public function create() {
        return view('bonds.create');
    }  
    
    public function store(Request $request) {
        $request->validate([
            'bondNumber' => 'required|integer',
            'bondSeries' => 'required|string|max:6',
            'buying_date' => 'nullable|date',
        ]);

        Auth::user()->bonds()->create($request->all());

        return redirect()->route('bonds.index')
                        ->with('success','Bond Inserted successfully.');
    } 

    public function show(Bond $bond){
        return view('bonds.show',compact('bond'));
    }  
    
    public function edit(Bond $bond){
        return view('bonds.edit',compact('bond'));
    } 
    
    public function update(Request $request, Bond $bond){
        $request->validate([
            'bondNumber' => 'required|integer',
            'bondSeries' => 'required|string|max:5',
            'buying_date' => 'nullable|date',
        ]);

        $bond->update($request->all());

        return redirect()->route('Bond.index')
                        ->with('success','Bond updated successfully');
    }  
    
    public function destroy(Bond $bond) {
        $bond->delete();

        return redirect()->route('bonds.index')
                        ->with('success','Bond deleted successfully');
    }
}
