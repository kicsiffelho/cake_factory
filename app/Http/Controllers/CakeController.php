<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('cakes.index', [
            'cakes' => Cake::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cakes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            unset($validated['image']);
            $cake = new Cake();
            $cake->user_id = $request->user()->id;
            $cake->name = $validated['name'];
            $cake->price = $validated['price'];
            $cake->image_path = $imagePath;
            $cake->save();
        }
        return redirect(route('cakes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cake $cake)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cake $cake): View
    {
        Gate::authorize('update', $cake);

        return view('cakes.edit', [
            'cake' => $cake
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cake $cake): RedirectResponse
    {
        Gate::authorize('update', $cake);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $cake->name = $validated['name'];
        $cake->price = $validated['price'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            unset($validated['image']);
            $cake->image_path = $imagePath;
        }

        $cake->save();

        return redirect(route('cakes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cake $cake):RedirectResponse
    {
        Gate::authorize('delete', $cake);

        $cake->delete();

        return redirect(route('cakes.index'));
    }
}
