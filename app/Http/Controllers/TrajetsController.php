<?php

namespace App\Http\Controllers;

use App\Models\taxi;
use App\Models\trajets;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrajetsController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'road' => 'required',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
        ]);

        $userId = Auth::id();
        // $taxi = taxi::join('drivers', 'taxi.driver_id', '=', 'drivers.driver_id')
        // ->join('model_has_roles', 'drivers.driver_id', '=', 'model_has_roles.model_id')
        // ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        // ->where('taxi.driver_id', '=' ,$userId)
        // ->where('roles.name', 'driver')
        // ->get();
        $taxiId = taxi::where('driver_id', $userId)->pluck('id')->first();

        

        $trajets = new trajets;
        $trajets->heurs_depart = $request->departure_time;
        $trajets->heurs_arrive = $request->arrival_time;
        $trajets->road_id = $request->road;
        $trajets->taxi_id = $taxiId;
        $trajets->save();
        return redirect()->route('dashboard');
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
