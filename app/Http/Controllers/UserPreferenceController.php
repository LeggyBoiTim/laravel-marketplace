<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserPreferenceController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        Gate::authorize('update', $user);

        $user->update([
            'notify_on_message' => $request->notify_on_message
        ]);

        return redirect()->back();
    }
}
