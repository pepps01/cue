<?php

namespace App\Http\Controllers\CueDriver;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVehicleRequest;
use App\Http\Requests\GetTripEarningsRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Requests\VerifyDriverRequest;
use App\Http\Resources\DriverResource;
use App\Http\Resources\DriverReviewResource;
use App\Http\Resources\TripEarningResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\VehicleResource;
use App\Models\Cart;
use App\Models\Driver;
use App\Models\DriverReview;
use App\Models\TripEarning;
use App\Models\User;
use App\Models\Vehicle;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DriverController extends Controller
{
    use ApiResponse;

    public function updateDriver(UpdateDriverRequest $request)
    {
        $data = $request->validated();
        if (isset($data['date_of_birth'])) {
            $age = Carbon::now()->diffInYears($data['date_of_birth']);
            abort_if($age < 20, ApiResponse::errorResponse("Only those that are 20 and above are allowed"), Response::HTTP_NOT_FOUND);
        }
        $user = User::find(auth()->user()->id);
        $driver = $user->profile;
        $user->update($data);
        $driver->update($data);
        return ApiResponse::successResponseWithData(new UserResource($user), "Updated was Successfull", Response::HTTP_OK);
    }

    public function verifyDriver(VerifyDriverRequest $request)
    {
        $data = $request->validated();
        $user = User::find(auth()->user()->id);
        $driver = $user->profile;

        //verify the driver's license using youverify
        // $verify = verifyDriversLicense($data['drivers_licence_number']);
        // if ($verify['data']['status'] == "not_found") {
        //     return ApiResponse::errorResponse($verify['data']['reason'], Response::HTTP_NOT_FOUND);
        // }
        // if ($verify['data']['status'] == "found" && $verify['data']['validations']['validationMessages'] != "") {
        //     return ApiResponse::errorResponse($verify['data']['validations']['validationMessages'], Response::HTTP_NOT_FOUND);
        // }

        if ($request->has('drivers_licence_front')) {
            $data['drivers_licence_front'] = pushFileStringToStorage($data['drivers_licence_front'], 'drivers_licence_front');
        }
        if ($request->has('drivers_licence_back')) {
            $data['drivers_licence_back'] = pushFileStringToStorage($data['drivers_licence_back'], 'drivers_licence_back');
        }

        $driver->update($data);
        return ApiResponse::successResponseWithData(new UserResource($user), "Verification Completed Successfully", Response::HTTP_OK);
    }

    public function addVehicle(CreateVehicleRequest $request)
    {
        $data = $request->validated();

        $user = User::find(auth()->user()->id);
        $driver = $user->profile;
        $data['driver_id'] = $driver->id;
        // $checkVehicle = Vehicle::where('driver_id', $driver->id)->exists();
        // abort_if($checkVehicle, ApiResponse::errorResponse("You have a vehicle registered already", Response::HTTP_CONFLICT));

        $data['plate_number_on_car_photo'] = pushFileStringToStorage($data['plate_number_on_car_photo'], 'plate_number_on_car_photo');

        if ($request->has('car_interior_photo')) {
            $data['car_interior_photo'] = pushFileStringToStorage($data['car_interior_photo'], 'car_interior_photo');
        }
        if ($request->has('car_exterior_photo')) {
            $data['car_exterior_photo'] = pushFileStringToStorage($data['car_exterior_photo'], 'car_exterior_photo');
        }

        $data['status'] = self::get_vehicle_status($data['year']);

        Vehicle::create($data);
        return ApiResponse::successResponseWithData(new UserResource($user), "Vehicle was added successfully", Response::HTTP_CREATED);
    }

    public function editVehicle(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $data = $request->validated();
        if ($request->has('plate_number_on_car_photo')) {
            $data['plate_number_on_car_photo'] = pushFileStringToStorage($data['plate_number_on_car_photo'], 'plate_number_on_car_photo');
        }
        if ($request->has('car_interior_photo')) {
            $data['car_interior_photo'] = pushFileStringToStorage($data['car_interior_photo'], 'car_interior_photo');
        }
        if ($request->has('car_exterior_photo')) {
            $data['car_exterior_photo'] = pushFileStringToStorage($data['car_exterior_photo'], 'car_exterior_photo');
        }

        $data['status'] = self::get_vehicle_status($data['year']);

        $vehicle->update($data);
        return ApiResponse::successResponseWithData(new VehicleResource($vehicle), "Vehicle Updated Successfully", Response::HTTP_OK);
    }

    public function deleteVehicle(Vehicle $vehicle)
    {
        $vehicle->delete();
        return ApiResponse::successResponse("Vehicle has been deleted successfully", Response::HTTP_OK);
    }

    public function updateStatus(Vehicle $vehicle, $status)
    {
        $vehicle->update(['status' => $status]);
        return ApiResponse::successResponse("Update was successful", Response::HTTP_OK);
    }

    public function goOnline()
    {
        $driver = auth()->user()->profile;
        abort_if($driver->is_online == true, ApiResponse::errorResponse("Driver is online already", Response::HTTP_BAD_REQUEST));
        $driver->update([
            'is_online' => true,
            'came_online_at' => Carbon::now()
        ]);
        return ApiResponse::successResponse("Driver is now online", Response::HTTP_OK);
    }

    public function goOffline()
    {
        $driver = auth()->user()->profile;
        abort_if($driver->is_online == false, ApiResponse::errorResponse("Driver is not online", Response::HTTP_BAD_REQUEST));
        $driver->update([
            'is_online' => false,
            'went_offline_at' => Carbon::now(),
            'total_online_duration' => $driver['total_online_duration'] + Carbon::parse(Carbon::now())->diffInMinutes($driver->came_online_at)
        ]);
        return ApiResponse::successResponse("Driver is now offline", Response::HTTP_OK);
    }

    public function tripEarnings(GetTripEarningsRequest $request)
    {
        $data = $request->validated();
        $driver = auth()->user()->profile;
        $earnings = TripEarning::where('driver_id', $driver->id)->where('status', true)->filter($data)->orderBy('created_at', 'DESC')->get();
        $metadata = [];
        $metadata['netFare'] = $earnings->sum('trip_fare');
        $metadata['commission'] = $earnings->sum('trip_comm');
        $metadata['totalTips'] = $earnings->sum('added_tip');
        $metadata['tripEarnings'] = $metadata['netFare'] - $metadata['commission'];
        $metadata['count'] = $earnings->count();
        $earningsResouurce = TripEarningResource::collection($earnings);
        return ApiResponse::successResponseWithMetadata($earningsResouurce, $metadata, "Trip Earnings retrieved", Response::HTTP_OK);
    }

    public function singleEarning(TripEarning $earning)
    {
        return ApiResponse::successResponseWithData(new TripEarningResource($earning), "Single Earning Retrieved", Response::HTTP_OK);
    }

    public function getDriverReviews(Driver $driver)
    {
        $reviews = DriverReview::where('driver_id', $driver->id)->orderBy('created_at', 'DESC')->get();
        $noOfRatings = $reviews->count();
        $average = $reviews->avg('rating');

        $stats = [
            'numberOfRatings' => $noOfRatings,
            'average' => $average,
            'noOfFive' => self::count_reviews($driver, 5),
            'noOfFour' => self::count_reviews($driver, 4),
            'noOfThree' => self::count_reviews($driver, 3),
            'noOfTwo' => self::count_reviews($driver, 2),
            'noOfOne' => self::count_reviews($driver, 1),
        ];
        return ApiResponse::successResponseWithMetadata(DriverReviewResource::collection($reviews), $stats, "Driver Reviews with Statistics", Response::HTTP_OK);
    }


    protected function count_reviews($driver, $value)
    {
        return DriverReview::where('driver_id', $driver->id)->where('rating', $value)->count();
    }

    protected function get_vehicle_status($year)
    {
        if (2002 <= $year && $year <= 2006) {
            $status = "economy";
        } elseif (2007 <= $year && $year <= 2011) {
            $status = "business";
        } elseif ($year >= 2012) {
            $status = "luxury";
        } else {
            abort(Response::HTTP_BAD_REQUEST, "The vehicle is too old");
        }
        return $status;
    }
}
