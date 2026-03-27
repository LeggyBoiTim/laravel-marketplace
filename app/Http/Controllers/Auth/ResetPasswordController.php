<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;

class ResetPasswordController extends Controller
{
    /**
     * Request a new password.
     */
    public function request()
    {
        return view('auth.forgot-password', ['title' => 'Forgot Password']);
    }

    /**
     * Send an e-mail requesting a new password.
     */
    public function email(Request $request)
    {
        $request->validate(['email' => ['required', 'email', 'string', 'max:255']]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status), 'email' => $request->email])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Reset the password.
     */
    public function reset(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Update the password in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => ['required', 'email', 'string', 'max:255'],
            'password' => ['required', 'string', RulesPassword::defaults()],
            'password_confirmation' => ['required', 'string', 'same:password'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login.create')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
