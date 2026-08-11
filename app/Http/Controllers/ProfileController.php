<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    // 2. Render the public profile page (with their chirps)
    public function show(User $user)
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    // 3. Handle the form submission and save profile changes
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'nullable|string|max:255|unique:users,username,' . $user->id,
        ]);

        // Update the user table record
        $user->update($validated);

        // Redirect back to the form with a success flag
        return redirect()->back()->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
        'password' => Hash::make($validated['password'])
    ]);

        return redirect()->back()->with('status', 'password-updated');
    }
}
