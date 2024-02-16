<?php

namespace App\Http\Controllers;

use App\Models\cities;
use App\Models\roads;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RoadController extends Controller
{



    public function getdistance($cityCoordinates)
    {
        $ch = curl_init();

        // Convert city names to coordinates using a geocoding service

        $requestData = [
            "locations" => $cityCoordinates,
        ];

        $requestDataJson = json_encode($requestData);

        curl_setopt($ch, CURLOPT_URL, "https://api.openrouteservice.org/v2/matrix/driving-car");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestDataJson);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8",
            "Authorization: 5b3ce3597851110001cf6248c1c02310e9eb472aa36c02b7aea5814a", // Replace with your actual API key
            "Content-Type: application/json; charset=utf-8"
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        // Parse response to extract distance
        $responseData = json_decode($response, true);
        $durations = $responseData['durations'];
        $durationInSeconds = $durations[0][1];
        $speed = 27;
        $distanceInMeters = $speed * $durationInSeconds;
        $distanceInKilometers = $distanceInMeters / 1000;

        return $distanceInKilometers;
    }
    

    private function conver_city_to_location($cityName)
    {
        $ch = curl_init();

        $requestUrl = "https://api.openrouteservice.org/geocode/autocomplete";
        $requestUrl .= "?api_key=5b3ce3597851110001cf6248c1c02310e9eb472aa36c02b7aea5814a";
        $requestUrl .= "&text=" . urlencode($cityName);

        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $responseData = json_decode($response, true);
        $coordinates = $responseData['features'][0]['geometry']['coordinates'];
        return $coordinates;
    }



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
        $cities = cities::all();

        return (view('road.add_road',compact('cities')));

    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        

        $request->validate([
            'arriv_city' => 'required|exists:cities,id',
            'depart_city' => 'required|exists:cities,id'
        ]);


        $arrivCity = cities::where('id', $request->arriv_city)->value('city');
        $departCity = cities::where('id', $request->depart_city)->value('city');

        // dd($arrivCity , $departCity);
        $cityCoordinates = [];
        
        if ($arrivCity != $departCity) {
            $location_arrive = $this->conver_city_to_location($arrivCity);
            $location_deppart = $this->conver_city_to_location($departCity);
            
            if ($location_arrive && $location_deppart) {
                $cityCoordinates[] = $location_arrive;
                $cityCoordinates[] = $location_deppart;
                
                $distance = $this->getdistance($cityCoordinates);
                // dd($distance);
                try {
                    $road = new roads();
                    $road->city_start = $request->arriv_city;
                    $road->city_arrive  = $request->depart_city;
                    $road->distance = $distance;
                
                    $road->save();
                
                    return redirect()->route('add_road')->with('success', 'Road information has been successfully saved.');
                } catch (QueryException $e) {
                    if ($e->errorInfo[1] == 1062) {
                        return redirect()->route('add_road')->with('error', 'Duplicate entry error occurred. Road information already exists.');
                    } else {

                        return redirect()->route('add_road')->with('error', 'Database error occurred: ' . $e->getMessage());
                    }
                }

            }

            return redirect()->route('road.create'); 
        }
        return redirect()->route('road.create');
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
