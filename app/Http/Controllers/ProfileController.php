<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'relation' => ['nullable', 'string', 'in:father,husband'],
            'relation_name' => ['nullable', 'string', 'max:255'],
            'dateOfClaimForm' => ['nullable', 'date'],
            'age' => ['nullable', 'integer', 'min:0'],
            'nationality' => ['nullable', 'string', 'max:255'],
            'village' => ['nullable', 'string', 'max:255'],
            'post' => ['nullable', 'string', 'max:255'],
            'thana' => ['nullable', 'string', 'max:255'],
            'zilla' => ['nullable', 'string', 'max:255'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'bankAccountNumber' => ['nullable', 'string', 'max:255'],
            'bankName' => ['nullable', 'string', 'max:255'],
            'bankBranch' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }
}
