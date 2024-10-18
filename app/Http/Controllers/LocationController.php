<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\SearchCountry;
use App\Models\State;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getStatesByCountry(Request $request)
    {
        $countryName = $request->input('country');
        $selectedCountry = SearchCountry::where('name', $countryName)->first();

        if ($selectedCountry) {
            $countryId = $selectedCountry->id;
            $states = State::select('id', 'name')
                ->where('country_id', $countryId)
                ->get();

            return response()->json($states);
        } else {
            return response()->json([]);
        }
    }

    public function getCitiesByState(Request $request)
    {
        $stateName = $request->input('state');
        $selectedState = State::where('name', $stateName)->first();

        if ($selectedState) {
            $stateId = $selectedState->id;
            $cities = City::select('id', 'name')
                ->where('state_id', $stateId)
                ->get();

            return response()->json($cities);
        } else {
            return response()->json([]);
        }
    }
}
