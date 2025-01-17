<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('dashboard', [
            'feedback' => Feedback::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feedback.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255'
        ]);

        $request->user()->feedback()->create($validated);

        return redirect(route('dashboard'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback): View
    {
        Gate::authorize('update', $feedback);

        return view('feedback.edit', [
            'feedback' => $feedback
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback): RedirectResponse
    {
        Gate::authorize('update', $feedback);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $feedback->update($validated);

        return redirect(route('dashboard'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback): RedirectResponse
    {
        Gate::authorize('delete', $feedback);

        $feedback->delete();

        return redirect(route('dashboard'));
    }
}
