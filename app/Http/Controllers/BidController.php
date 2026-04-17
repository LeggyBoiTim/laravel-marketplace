<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidRequest;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BidController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(BidRequest $request)
    {
        Gate::authorize('create', Bid::class);

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
        Gate::authorize('delete', $bid);

        $bid->delete();

        return redirect()->route('ads.show', $bid->ad_id);
    }
}
