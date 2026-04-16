<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
    public function email(ForgotPasswordRequest $request)
    {
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
    public function update(ResetPasswordRequest $request)
    {
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
