<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MyAdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Auth::user()->ads->sortByDesc('created_at');
        return view('ads.index', ['title' => 'My Ads'], compact('ads'));
    }
}
