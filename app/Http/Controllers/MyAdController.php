<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class MyAdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Ad::query()->orderBy('created_at', 'desc');

        $ads = $query->where('user_id', Auth::id())->simplePaginate(10);
        
        return view('ads.index', ['title' => 'My Ads', 'categories' => Category::all()], compact('ads'));
    }
}
