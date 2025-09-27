<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function handleForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:registrations,email',
            'password' => 'required|min:6',
        ]);

        // Store in database
        Registration::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('register.success')->with([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
    }

    public function success(Request $request)
    {
        return view('success', [
            'name' => session('name'),
            'email' => session('email'),
        ]);
    }
}
