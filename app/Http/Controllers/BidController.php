<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidRequest;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(BidRequest $request)
    {
        Bid::create([
            'ad_id' => $request->ad_id,
            'user_id' => Auth::id(),
            'price' => $request->price,
        ]);

        return redirect()->route('ads.show', $request->ad_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bid $bid)
    {
        $bid->delete();

        return redirect()->route('ads.show', $bid->ad_id);
    }
}
