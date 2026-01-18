<?php

namespace Plugin\Location\Http\Controllers\Api;

use Plugin\Location\Models\Country;
use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Plugin\Location\Http\ApiResource\CityResource;
use Plugin\Location\Http\ApiResource\CountryResource;
use Plugin\Location\Http\ApiResource\SingleCityResource;
use Plugin\Location\Http\ApiResource\StateResource;
use Plugin\Location\Models\City;
use Plugin\Location\Models\State;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationController extends ApiController
{
    /**
     * Will return countries list
     */
    public function countries(): CountryResource
    {
        $default_country = getGeneralSetting('default_country');
        $countries = Country::where('id', $default_country)
            ->where('status', config('settings.general_status.active'))
            ->get();

        return new CountryResource($countries);
    }

    /**
     * Will return state of a country
     */
    public function states(Request $request): StateResource
    {
        $states = State::where('country_id', $request['country'])
            ->where('status', config('settings.general_status.active'))
            ->get();

        return new StateResource($states);
    }

    /**
     * Will return cities of a state
     */
    public function cities(Request $request): CityResource
    {
        $cities = City::where('state_id', $request['state'])
            ->where('status', config('settings.general_status.active'))
            ->get();

        return new CityResource($cities);
    }
    /**
     * Will return city Details
     */
     public function cityDetails(Request $request): JsonResource | SingleCityResource
    {
        $city = City::with(['state'])
            ->where('id', $request['city_id'])
            ->where('status', config('settings.general_status.active'))
            ->first();

        if ($city != null) {
            return new SingleCityResource($city);
        }
        return new JsonResource([
            'success' => false,
            'message' => 'City not found or inactive',
        ]);
    }
}
