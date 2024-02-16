<?php

namespace App\Http\Controllers;

use App\Models\taxi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('taxi.taxi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'matricule' => 'required|string|max:20',
            'capacity' => 'required|integer',
            'PPK' => 'required|numeric',
            'type' => 'required|string',
        ]);

        $user = Auth::user();

        $userId = $user->id;

        if(Auth::user()->roles->first()->name == 'driver'){
            $taxi = new taxi();
            $taxi->matricule = $validatedData['matricule'];
            $taxi->capacity = $validatedData['capacity'];
            $taxi->PPK = $validatedData['PPK'];
            $taxi->type = $validatedData['type'];
            $taxi->driver_id = $userId;
            $taxi->ratting = 0 ;
            $taxi->save();

            return redirect()->route('add_road')->with('success', 'Taxi information has been successfully saved.');
        }


        


        // return redirect()->route('add_road')->with('success', 'Taxi information has been successfully saved.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
