<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdRequest;
use App\Models\Ad;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryId = request()->query('category');
        $search = request()->query('search');
        $query = Ad::query()->orderBy('created_at', 'desc');

        if ($categoryId) { // Filter by category
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        if ($search) { // Search by title, description, or category name
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhereHas('categories', function ($subQ) use ($search) {
                    $subQ->where('name', 'like', "%$search%");
                });
            });
        }

        $ads = $query->simplePaginate(10)->withQueryString();

        return view('ads.index', ['title' => 'All Ads', 'categories' => Category::all()], compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ads.create', ['title' => 'New Ad', 'categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdRequest $request)
    {
        Ad::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ])->categories()->attach($request->categories);

        return redirect()->route('ads.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ad $ad)
    {
        return view('ads.show', ['title' => $ad->title], compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ad $ad)
    {
        return view('ads.edit', ['title' => 'Edit Ad', 'categories' => Category::all()], compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdRequest $request, Ad $ad)
    {
        $ad->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        $ad->categories()->sync($request->categories);

        return redirect()->route('ads.show', $ad);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->route('ads.index');
    }
}
