<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\GmailOnly;
use App\Rules\SaudiMobile;
use App\Rules\SaudiNationalId;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', new SaudiMobile()],
            'national_id' => ['required', 'string', new SaudiNationalId()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new GmailOnly()],
            'password' => ['required', 'confirmed', /*Rules\Password::defaults()*/],
        ]);

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'national_id' => $request->national_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
