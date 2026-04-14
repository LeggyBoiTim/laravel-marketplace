<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPreferenceController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'notify_on_message' => $request->notify_on_message
        ]);

        return redirect()->back();
    }
}
