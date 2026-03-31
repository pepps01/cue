<?php

namespace App\Http\Controllers\Cue;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayTripRequest;
use App\Http\Requests\RequestTripRequest;
use App\Http\Requests\ReviewDriverRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Http\Resources\DriverReviewResource;
use App\Http\Resources\TripResource;
use App\Http\Resources\UserResource;
use App\Models\Driver;
use App\Models\DriverReview;
use App\Models\Rider;
use App\Models\Trip;
use App\Models\TripEarning;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\ApiResponse;
use App\Traits\PaymentTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CueTripController extends Controller
{
    use ApiResponse;
    use PaymentTraits;

    public function myTrips()
    {
        $rider = auth()->user()->profile;
        $trips = Trip::where('rider_id', $rider->id)->orderBy('created_at', 'DESC')->get();
        return ApiResponse::successResponseWithData(TripResource::collection($trips), "All my Trips retrieved", Response::HTTP_OK);
    }

    public function requestTrip(RequestTripRequest $request, Driver $driver)
    {
        $data = $request->validated();

        $rider = auth()->user()->profile;
        $checkOngoingTrip = Trip::where('rider_id', $rider->id)->where('status', "Ongoing")->exists();
        if ($checkOngoingTrip == true) {
            return ApiResponse::errorResponse("You cannot request another trip when there's still an ongoing trip", Response::HTTP_BAD_REQUEST);
        }

        $data['rider_id'] = $rider->id;
        $data['driver_id'] = $driver->id;
        $data['status'] = "Requested";
        $data['request_date_time'] = Carbon::now();

        $trip = $rider->trips()->create($data);

        //notify the driver
        newNotification($rider->user_id, $driver->user_id, $trip->id, "Trip", config('constants.trip.request.title'), config('constants.trip.request.message'), true);

        return ApiResponse::successResponseWithData(new TripResource($trip), "New Trip Request has been initiated", Response::HTTP_CREATED);
    }

    public function singleTrip(Trip $trip)
    {
        return ApiResponse::successResponseWithData(new TripResource($trip), "Single Trip Retrieved", Response::HTTP_OK);
    }

    public function cancelTrip(Trip $trip)
    {
        if ($trip->status == "Ongoing") {
            return ApiResponse::errorResponse("Cannot cancel an Ongoing Trip", Response::HTTP_BAD_REQUEST);
        }
        $trip->update(['status' => "Canceled", 'canceled_by' => 'rider']);

        if ($trip->driver_id != null) {
            $driver = $trip->driver;
            //notify the driver
            newNotification(auth()->user()->id, $driver->user_id, $trip->id, "Trip", config('constants.trip.rider_cancel.title'), config('constants.trip.rider_cancel.message'), true);
        }
        return ApiResponse::successResponseWithData(new TripResource($trip), "Trip was canceled successfully", Response::HTTP_ACCEPTED);
    }

    public function updateDestination(UpdateDestinationRequest $request, Trip $trip)
    {
        $data = $request->validated();
        $trip->update($data);
        return ApiResponse::successResponseWithData(new TripResource($trip), "Drop Off Location has been updated", Response::HTTP_OK);
    }

    public function payForTrip(Trip $trip, PayTripRequest $request)
    {
        $data = $request->validated();
        $amount = $data['amount'];
        if ($trip->status != "Completed") {
            return ApiResponse::errorResponse("Sorry!, Trip must be completed before payment is made", Response::HTTP_BAD_REQUEST);
        }

        if ($request->has('tip_amount')) {
            $added_tip = $data['tip_amount'];
            $trip_fare = $data['amount'] - $data['tip_amount']; //subtract the added tip from amount to get the main trip fare amount
        } else {
            $added_tip = 0;
            $trip_fare = $data['amount'];
        }

        if ($data['payment_method'] == "wallet") {
            $this->pay_with_wallet($data, "Payment for Trip");
        }

        if ($data['payment_method'] == "paystack") {
            $this->pay_with_paystack($data, "Payment for Trip");
        }

        if ($data['payment_method'] == "flw") {
            $this->pay_with_flw($data, "Payment for Trip");
        }

        if ($data['payment_method'] == "card") {
            $this->pay_with_card($data, "Payment for Trip");
        }
        //assign point value to riders
        $this->assign_point_value($trip_fare);

        $driver = $trip->driver;
        $driverWallet = $driver->user->wallet;
        $trip_comm = ($trip_fare * env('TRIP_COMMISSION_PERCENTAGE'));
        $amount_after_comm = $amount - $trip_comm;
        $driverWallet->update([
            'withdrawable_amount' => $driverWallet['withdrawable_amount'] + $amount_after_comm
        ]);
        $trip->update(['is_paid' => true, 'total_price' => $trip_fare]);

        //create earnings for driver
        $this->create_driver_earning($trip->id, $trip->driver_id, auth()->user()->fullname, $trip_fare, $trip_comm, $added_tip);

        //log informaation into the driver's transactions
        $this->create_trans_history($amount_after_comm, $data['payment_method'], 'payment for trip', $data['payment_reference'] ?? null, 'successfull', $driver->user);

        //notify the driver
        newNotification(auth()->user()->id, $driver->user_id, $trip->id, "Trip", config('constants.trip.paid.title'), config('constants.trip.paid.message'), true);

        return ApiResponse::successResponseWithData(new TripResource($trip), "Payment has been completed Successfully", Response::HTTP_OK);
    }

    public function deleteTrip(Trip $trip)
    {
        if ($trip->status == "Requested" || $trip->status == "Accepeted" || $trip->status == "Ongoing") {
            return ApiResponse::errorResponse("Trip cannot be deleted", Response::HTTP_BAD_REQUEST);
        }
        $trip->delete();
        return ApiResponse::successResponse("Trip has been removed successfully", Response::HTTP_OK);
    }

    public function reviewDriver(User $user, ReviewDriverRequest $request)
    {
        $data = $request->validated();
        $rider = User::find(auth()->user()->id);
        $driver = $user->profile;
        $data['driver_id'] = $driver->id;
        $data['rider_user_id'] = $rider['id'];
        $data['reviewer'] = $rider['fullname'];

        $review = DriverReview::create($data);

        //notify the driver
        newNotification(auth()->user()->id, $user->id, $review->id, "DriverReview", config('constants.trip.paid.title'), config('constants.trip.paid.message'), true);

        $reviewResource = new DriverReviewResource($review);
        return ApiResponse::successResponseWithData($reviewResource, "Review was sent successfully", Response::HTTP_OK);
    }

    public function updateDriverForTrip(Request $request, Trip $trip)
    {
        if (isset($request->driver_id)) {
            $driver = Driver::find($request->driver_id);
            abort_if(!$driver, ApiResponse::errorResponse("Driver does not exist", Response::HTTP_NOT_FOUND));
            $driverID = $request->driver_id;
        } else {
            $driverID = null;
        }
        $trip->update(['driver_id' => $driverID, 'status' => 'Requested']);
        return ApiResponse::successResponseWithData(new TripResource($trip), "Driver was updated successfully", Response::HTTP_CREATED);
    }



    private function create_driver_earning($tripID, $driverID, $rider_name, $tripFare, $trip_comm, $added_tip)
    {
        $earning = TripEarning::create([
            'trip_id' => $tripID,
            'driver_id' => $driverID,
            'rider' => $rider_name,
            'trip_fare' => $tripFare,
            'trip_comm' => $trip_comm,
            'added_tip' => $added_tip,
        ]);

        return $earning;
    }

    private function assign_point_value($amount): void
    {
        $points = floor($amount / env('AMOUNT_PER_POINT'));
        $user = User::find(auth()->user()->id);
        $user->wallet->update([
            'points' => $user->wallet->points + $points
        ]);
    }
}
