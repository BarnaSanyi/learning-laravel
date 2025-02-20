<?php

namespace App\Http\Controllers;

use App\Models\Ter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class TerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('ters.index', 
        [
            'ters' => Ter::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->ters()->create($validated);

        return redirect(route('ters.index'));   
    }

    /**
     * Display the specified resource.
     */
    public function show(Ter $ter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ter $ter): View
    {
        Gate::authorize('update', $ter);
    
        return view('ters.edit', [
            'ter' => $ter,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ter $ter): RedirectResponse
    {
        Gate::authorize('update', $ter);

        $validated = $request->validate([

            'message' => 'required|string|max:255',

        ]);

        $ter->update($validated);

        return redirect(route('ters.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ter $ter): RedirectResponse
    {
        Gate::authorize('delete', $ter);

        $ter->delete();

        return redirect(route('ters.index'));
    }
}
