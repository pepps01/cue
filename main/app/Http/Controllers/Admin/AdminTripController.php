<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;
use App\Models\Driver;
use App\Models\Rider;
use App\Models\Trip;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminTripController extends Controller
{
    use ApiResponse;

    public function getAllTrips()
    {
        $trips = Trip::orderBy('created_at', 'DESC')->get();
        $tripResource = TripResource::collection($trips);
        return ApiResponse::successResponseWithData($tripResource, "All Trips retrieved", Response::HTTP_OK);
    }

    public function singleTrip(Trip $trip)
    {
        $tripResource = new TripResource($trip);
        return ApiResponse::successResponseWithData($tripResource, "Single trip retrieved", Response::HTTP_OK);
    }

    public function tripByRider(User $user)
    {
        $rider = Rider::where('user_id', $user->id)->first();
        $trips = Trip::where('rider_id', $rider->id)->orderBy('created_at', 'DESC')->get();
        $tripResource = TripResource::collection($trips);
        return ApiResponse::successResponseWithData($tripResource, "Trips by Rider retrieved", Response::HTTP_OK);
    }

    public function tripByDriver(User $user)
    {
        $driver = Driver::where('user_id', $user->id)->first();
        $trips = Trip::where('driver_id', $driver->id)->orderBy('created_at', 'DESC')->get();
        $tripResource = TripResource::collection($trips);
        return ApiResponse::successResponseWithData($tripResource, "Trips by Driver retrieved", Response::HTTP_OK);
    }

    public function deleteTrip(Trip $trip)
    {
        $trip->delete();
        saveAdminActivityLog("trip_deleted", "Trip", $trip->id);
        return ApiResponse::successResponse("Trip has been removed", Response::HTTP_OK);
    }
}
