<?php

namespace App\Http\Controllers;

use App\Http\Resources\AllBankResource;
use App\Http\Resources\CarResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\LgaResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\TripLocationPricingResource;
use App\Http\Resources\TripPricingResource;
use App\Models\Bank;
use App\Models\CarListing;
use App\Models\Country;
use App\Models\Lga;
use App\Models\State;
use App\Models\TripLocationPricingEconomy;
use App\Models\TripLocationPricingEssential;
use App\Models\TripLocationPricingLuxury;
use App\Models\TripPricing;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneralController extends Controller
{
    use ApiResponse;

    public function getAllCountries()
    {
        $countries = Country::all();
        return ApiResponse::successResponseWithData(CountryResource::collection($countries), "All Countries retrieved", Response::HTTP_OK);
    }

    public function singleCountry(Country $country)
    {
        return ApiResponse::successResponseWithData(new CountryResource($country), "Single Country Retrieved", Response::HTTP_OK);
    }

    public function getStates(Country $country)
    {
        $states = State::where('country_id', $country->id)->get();
        return ApiResponse::successResponseWithData(StateResource::collection($states), "All States in " . $country->name . " retrieved", Response::HTTP_OK);
    }

    public function singleState(State $state)
    {
        return ApiResponse::successResponseWithData(new StateResource($state), "Single State retrieved", Response::HTTP_OK);
    }

    public function getAllLgas(State $state)
    {
        $lgas = Lga::where('state_id', $state->id)->get();
        $lgaResource = LgaResource::collection($lgas);
        return ApiResponse::successResponseWithData($lgaResource, "All Lgas in " . $state->name . " State retrieved", Response::HTTP_OK);
    }

    public function getSingleLga(Lga $lga)
    {
        return ApiResponse::successResponseWithData(new LgaResource($lga), "Single LGA retrieved", Response::HTTP_OK);
    }

    public function getBanks()
    {
        $banks = Bank::orderBy('bank_name')->get();
        return ApiResponse::successResponseWithData(AllBankResource::collection($banks), "All Banks retrieved", Response::HTTP_OK);
    }

    public function getSingleBank(Bank $bank)
    {
        return ApiResponse::successResponseWithData(new AllBankResource($bank), "Single Bank retrieved", Response::HTTP_OK);
    }

    public function getCars()
    {
        $cars = CarListing::orderBy('manufacturer', 'ASC')->get();
        return ApiResponse::successResponseWithData(CarResource::collection($cars), "All Cars Retrieved", Response::HTTP_OK);
    }

    public function getManufacturers()
    {
        $manufacturers = CarListing::orderBy('manufacturer', 'ASC')->pluck('manufacturer')->unique()->toArray();
        return ApiResponse::successResponseWithData(array_values($manufacturers), "All Manufacturers", Response::HTTP_OK);
    }

    public function getModels(Request $request)
    {
        $cars = CarListing::where('manufacturer', $request->manufacturer)->orderBy('model', 'ASC')->get();
        return ApiResponse::successResponseWithData(CarResource::collection($cars), "Cars Retrieved", Response::HTTP_OK);
    }

    public function getTripPricing()
    {
        $pricings = TripPricing::all();
        return ApiResponse::successResponseWithData(TripPricingResource::collection($pricings), "Trip pricings Retrieved", Response::HTTP_OK);
    }

    public function getTripLocationPricing(string $status)
    {
        switch ($status) {
            case ("essential"):
                $pricings = TripLocationPricingEssential::all();
                break;
            case ("luxury"):
                $pricings = TripLocationPricingLuxury::all();
                break;
            case ("economy"):
                $pricings = TripLocationPricingEconomy::all();
                break;
            default:
                abort(Response::HTTP_BAD_REQUEST, "Status does not Exists");
        }
        return ApiResponse::successResponseWithData(TripLocationPricingResource::collection($pricings, $status), "Pricings Retrived ($status)", Response::HTTP_OK);
    }

    public function getTripLocationPricingByID(string $status, $id)
    {
        switch ($status) {
            case ("essential"):
                $pricing = TripLocationPricingEssential::where('id', $id)->first();
                break;
            case ("luxury"):
                $pricing = TripLocationPricingLuxury::where('id', $id)->first();
                break;
            case ("economy"):
                $pricing = TripLocationPricingEconomy::where('id', $id)->first();
                break;
            default:
                abort(Response::HTTP_BAD_REQUEST, "Status does not Exists");
        }
        if (!$pricing) {
            return ApiResponse::errorResponse("Record was not found", Response::HTTP_NOT_FOUND);
        }
        return ApiResponse::successResponseWithData(new TripLocationPricingResource($pricing, $status), "Record Retrived", Response::HTTP_OK);
    }

    public function getTripLocationPricingByState(string $status, $state)
    {
        switch ($status) {
            case ("essential"):
                $pricing = TripLocationPricingEssential::where('state', "LIKE", "%" . $state . "%")->first();
                break;
            case ("luxury"):
                $pricing = TripLocationPricingLuxury::where('state', "LIKE", "%" . $state . "%")->first();
                break;
            case ("economy"):
                $pricing = TripLocationPricingEconomy::where('state', "LIKE", "%" . $state . "%")->first();
                break;
            default:
                abort(Response::HTTP_BAD_REQUEST, "Status does not Exists");
        }
        if (!$pricing) {
            return ApiResponse::errorResponse("Could not get trip prices for this location", Response::HTTP_NOT_FOUND);
        }
        return ApiResponse::successResponseWithData(new TripLocationPricingResource($pricing, $status), "Record Retrived", Response::HTTP_OK);
    }
}
