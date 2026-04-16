<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdPromoteRequest;
use App\Models\Ad;

class AdPromoteController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(AdPromoteRequest $request, Ad $ad)
    {
        $ad->update([
            'is_promoted' => $request->is_promoted,
            'promoted_at' => $request->is_promoted ? now() : null
        ]);

        return redirect()->back();
    }
}
