<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use App\Models\roads;
use App\Models\taxi;
use App\Models\trajets;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

        public function add_to_reservation($id)
    {
        $userId = Auth::id();   
        $reservation = new reservation();
        
        $reservation->trajet_id = $id;
        $reservation->passenger_id = $userId;
        $reservation->ratting = 0 ;

        $reservation->save();
    
    }
        public function addroad()
    {

        
        $roads = DB::table('roads')
        ->select('roads.id as id',
                 'roads.distance as distance',
                 DB::raw('(SELECT city FROM cities WHERE cities.id = roads.city_start) as city_start'),
                 DB::raw('(SELECT city FROM cities WHERE cities.id = roads.city_arrive) as city_arrive'))
        ->get();
        $userId = Auth::id();
        $taxi = taxi::join('drivers', 'taxi.driver_id', '=', 'drivers.driver_id')
        ->join('model_has_roles', 'drivers.driver_id', '=', 'model_has_roles.model_id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('taxi.driver_id', $userId)
        ->where('roles.name', 'driver')
        ->get();

        
        $trajet_info = DB::table('trajets')
        ->join('roads', 'trajets.road_id', '=', 'roads.id')
        ->join('taxi', 'trajets.taxi_id', '=', 'taxi.id')
        ->join('cities as start_city', 'start_city.id', '=', 'roads.city_start')
        ->join('cities as arrive_city', 'arrive_city.id', '=', 'roads.city_arrive')
        ->where('taxi.driver_id' , '=' , $userId)
        ->select(
            'trajets.id as id',
            'roads.id as road_id',
            'roads.distance as distance',
            'start_city.city as city_start',
            'arrive_city.city as city_arrive',
            'taxi.ratting as ratting',
            'taxi.capacity as capacity',
            'trajets.heurs_depart',
            'trajets.heurs_arrive',
            'taxi.PPK'
        )
        ->get();
            
            
        return view('driver.addroad' , compact('taxi' , 'roads', 'trajet_info'));
    }
    public function show_all_roads (){

        $trajet_info = DB::table('trajets')
        ->join('roads', 'trajets.road_id', '=', 'roads.id')
        ->join('taxi', 'trajets.taxi_id', '=', 'taxi.id')
        ->join('cities as start_city', 'start_city.id', '=', 'roads.city_start')
        ->join('cities as arrive_city', 'arrive_city.id', '=', 'roads.city_arrive')
        ->select(
            'trajets.id as id',
            'roads.id as road_id',
            'roads.distance as distance',
            'start_city.city as city_start',
            'arrive_city.city as city_arrive',
            'taxi.ratting as ratting',
            'taxi.capacity as capacity',
            'trajets.heurs_depart',
            'trajets.heurs_arrive',
            'taxi.PPK'
        )
        ->get();

        return view('trajets.trajets' , compact('trajet_info'));
    }
}
