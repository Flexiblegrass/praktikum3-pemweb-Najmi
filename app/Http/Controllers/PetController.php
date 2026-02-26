<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Species;
use App\Models\Visit;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['species', 'breed', 'visits'])->get();

        $totalPatients = Pet::count();

        $todayVisits = Visit::whereDate('visit_date', today())->count();

        $sickToday = Visit::where('status', 'Sakit')
                            ->whereDate('visit_date', today())
                            ->count();

        return view('pets.index', compact(
            'pets',
            'totalPatients',
            'todayVisits',
            'sickToday'
        ));
    }

    public function create()
    {
        $species = Species::all();
        return view('pets.create', compact('species'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_name'   => 'required',
            'owner_name' => 'required',
            'species_id' => 'required|exists:species,id',
            'breed_id'   => 'required|exists:breeds,id',
            'age_value'  => 'required|integer|min:0',
            'age_unit'   => 'required',
            'gender'     => 'required',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('pets', 'public');
            $validated['photo'] = $path;
        }

        Pet::create($validated);

        return redirect()->route('pets.index')
            ->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function edit(Pet $pet)
    {
        $species = Species::all();
        return view('pets.edit', compact('pet', 'species'));
    }

    public function update(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'pet_name'   => 'required',
            'owner_name' => 'required',
            'species_id' => 'required|exists:species,id',
            'breed_id'   => 'required|exists:breeds,id',
            'age_value'  => 'required|integer|min:0',
            'age_unit'   => 'required',
            'gender'     => 'required',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('pets', 'public');
            $validated['photo'] = $path;
        }

        $pet->update($validated);

        return redirect()->route('pets.index')
            ->with('success', 'Data pasien berhasil diupdate.');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

        return redirect()->route('pets.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}