<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\SearchCountry;
use App\Models\State;
use Illuminate\Http\Request;

/**
 * Controller for handling location-based operations
 * Manages country, state, and city data for location selection
 */
class LocationController extends Controller
{
    /**
     * Get states for a given country
     * Used for dynamic location dropdowns
     * 
     * @param Request $request Contains country name
     * @return \Illuminate\Http\JsonResponse List of states for the country
     */
    public function getStatesByCountry(Request $request)
    {
        // Get country name from request
        $countryName = $request->input('country');
        
        // Find the country record
        $selectedCountry = SearchCountry::where('name', $countryName)->first();

        if ($selectedCountry) {
            // Get all states for the selected country
            $states = State::select('id', 'name')
                ->where('country_id', $selectedCountry->id)
                ->get();

            // Return states as JSON response
            return response()->json($states);
        } else {
            // Return empty array if country not found
            return response()->json([]);
        }
    }

    /**
     * Get cities for a given state
     * Used for dynamic location dropdowns
     * 
     * @param Request $request Contains state name
     * @return \Illuminate\Http\JsonResponse List of cities for the state
     */
    public function getCitiesByState(Request $request)
    {
        // Get state name from request
        $stateName = $request->input('state');
        
        // Find the state record
        $selectedState = State::where('name', $stateName)->first();

        if ($selectedState) {
            // Get all cities for the selected state
            $cities = City::select('id', 'name')
                ->where('state_id', $selectedState->id)
                ->get();

            // Return cities as JSON response
            return response()->json($cities);
        } else {
            // Return empty array if state not found
            return response()->json([]);
        }
    }
}
