<?php

namespace Database\Seeders;

use App\Models\cities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class cities_with_API extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $response = Http::withHeaders([
            'X-Parse-Application-Id' => 'lFwLMavNfk1X7lvjKk9frb111pFZ2Hr3JiMn8z0g',
            'X-Parse-REST-API-Key' => 'gGETg0RsALzckzfFt040Rd3VVCwxXIHTOcqaoGTj',
        ])->get('https://parseapi.back4app.com/classes/CitiesMorocco_List_of_Morroco_cities?keys=asciiname');
        

        
        $data = $response->json();

        if (isset($data['results'])) {
            
            foreach ($data['results'] as $cityData) {
                cities::create([
                    'city' => $cityData['asciiname'],
                ]);
            }
        }
    }
}
