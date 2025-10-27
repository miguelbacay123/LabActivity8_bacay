<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        // Validation with custom messages
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Please enter your username or email',
            'password.required' => 'Please enter your password',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Try to find user by username or email
        $user = User::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->first();

        // Check if user exists and password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            // Manually log in the user
            Auth::login($user, $request->remember ?? false);
            
            // Regenerate session for security
            $request->session()->regenerate();
            
            // Redirect to posts instead of dashboard
            return redirect()->route('posts.index')->with('success', 'Welcome back, ' . $user->name . '!');
        }

        // If authentication fails
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput()->with('error', 'Login failed. Please check your credentials.');
    }

    // Show Registration Form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        // Validation with custom messages
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'username' => 'required|string|max:255|unique:users|regex:/^[a-zA-Z0-9_]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Please enter your full name',
            'name.regex' => 'Name can only contain letters and spaces',
            'username.required' => 'Please choose a username',
            'username.unique' => 'This username is already taken',
            'username.regex' => 'Username can only contain letters, numbers, and underscores',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already registered',
            'password.required' => 'Please enter a password',
            'password.min' => 'Password must be at least 8 characters long',
            'password.confirmed' => 'Passwords do not match',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Create user
            $user = User::create([
                'name' => trim($request->name),
                'username' => trim($request->username),
                'email' => trim($request->email),
                'password' => Hash::make($request->password),
            ]);

            // Log in the user automatically after registration
            Auth::login($user);

            // Regenerate session for security
            $request->session()->regenerate();

            // Redirect to posts instead of dashboard
            return redirect()->route('posts.index')->with('success', 'Account created successfully! Welcome to Portfolio Management System.');

        } catch (\Exception $e) {
            return back()->with('error', 'Registration failed. Please try again.')->withInput();
        }
    }

    // Handle Logout
    public function logout(Request $request)
    {
        // Get user name for message before logging out
        $userName = Auth::user()->name ?? 'User';

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Goodbye, ' . $userName . '! You have been logged out successfully.');
    }
}