<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
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
     * @throws \Illuminate\Validation\ValidationException
     */
   
    private function creationAtrritbutes($validated)
    {
        return
            [
                'user_name' => $validated['user_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ];
    }
    public function store(Request $request): RedirectResponse
    {


        $validated =   $request->validate(
            [
                'user_name' => ['required', 'string', 'max:255', 'unique:' . User::class],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],

            ]
        );
      

        $user = User::create(
            $this->creationAtrritbutes($validated)
        );
        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}
