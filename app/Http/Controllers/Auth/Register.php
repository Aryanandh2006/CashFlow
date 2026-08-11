<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            "name"=> "required|string|max:255",
            "email"=> "required|email|max:255|unique:users",
            "password"=> "required|string|min:8|confirmed",
        ]);

        $user = User::create([
            "name"=> $validated["name"],
            "email"=> $validated["email"],
            "password"=> Hash::make($validated["password"]),
        ]);

        Auth::login($user);
        return redirect()->route("dashboard")->with("success","Welcome to CashFlow");
    }

}
