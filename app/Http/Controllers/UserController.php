<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        // Check if user is already authenticated
        if (Auth::check()) {
            return redirect('/notes');  // Redirect to notes if user is already logged in
        }

        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        // Validate the login credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/notes');  // Redirect to notes after successful login
        }

        return back()->with('error', 'Invalid credentials. Please try again.');
    }

    // Show the registration form
    public function showRegistrationForm()
    {
        // Check if user is already authenticated
        if (Auth::check()) {
            return redirect('/notes');  // Redirect to notes if user is already logged in
        }

        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Create the user
        $user = \App\Models\User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Log the user in after registration
        Auth::login($user);

        return redirect('/notes');
    }
}
