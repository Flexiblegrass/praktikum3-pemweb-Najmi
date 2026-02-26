<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function create(Pet $pet)
    {
        return view('visits.create', compact('pet'));
    }

    public function store(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'visit_date' => 'required|date',
            'status'     => 'required',
            'weight'     => 'nullable|numeric|min:0',
            'notes'      => 'nullable|string',
            'follow_up'  => 'nullable|string'
        ]);

        Visit::create([
            'pet_id'    => $pet->id,
            'visit_date'=> $validated['visit_date'],
            'status'    => $validated['status'],
            'weight'    => $validated['weight'] ?? null,
            'notes'     => $validated['notes'] ?? null,
            'follow_up' => $validated['follow_up'] ?? null,
        ]);

        return redirect()->route('pets.index')
            ->with('success', 'Kunjungan berhasil ditambahkan.');
    }
}