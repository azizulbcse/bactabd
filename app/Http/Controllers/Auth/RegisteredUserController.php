<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ১. আন্তর্জাতিক মানের সিকিউর ভ্যালিডেশন (সব ফিল্ড Mandatory)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'bmdc_reg_no' => ['required', 'string', 'max:50', 'unique:'.User::class],
            'designation' => ['required', 'string', 'max:255'],
            'member_type' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ২. ডাটাবেজে ডেটা সেভ (status ডিফল্টভাবে ১ বা Pending থাকবে)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'bmdc_reg_no' => $request->bmdc_reg_no,
            'designation' => $request->designation,
            'member_type' => $request->member_type,
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);

        event(new Registered($user));
        return redirect()->route('login')->with('success', 'Your membership application has been submitted successfully. Please wait for BACTA Admin approval.');
    }
}
