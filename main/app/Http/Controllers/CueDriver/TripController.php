<?php

namespace App\Http\Controllers\CueDriver;

use App\Http\Controllers\Controller;
use App\Http\Requests\CancelTripRequest;
use App\Http\Requests\EndTripRequest;
use App\Http\Requests\ReviewRiderRequest;
use App\Http\Requests\StartTripRequest;
use App\Http\Resources\RiderReviewResource;
use App\Http\Resources\TripResource;
use App\Models\Driver;
use App\Models\Rider;
use App\Models\RiderReview;
use App\Models\Trip;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\PerformanceRewardNotification;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    use ApiResponse;

    public function myTrips()
    {
        $driver = auth()->user()->profile;
        $trips = Trip::where('driver_id', $driver->id)->orderBy('created_at', 'DESC')->get();
        return ApiResponse::successResponseWithData(TripResource::collection($trips), "All my Trips retrieved", Response::HTTP_OK);
    }

    public function singleTrip(Trip $trip)
    {
        return ApiResponse::successResponseWithData(new TripResource($trip), "Single Trip Retrieved", Response::HTTP_OK);
    }

    public function acceptTrip(Trip $trip)
    {
        $trip->update(['status' => "Accepted", 'request_acceptance_time' => Carbon::now()]);

        $rider = $trip->rider;
        newNotification(auth()->user()->id, $rider->user_id, $trip->id, "Trip", config('constants.trip.driver_accepted.title'), config('constants.trip.driver_accepted.message'), true);

        return ApiResponse::successResponseWithData(new TripResource($trip), "Trip request was accepted successfully", Response::HTTP_ACCEPTED);
    }

    public function rejectTrip(Trip $trip)
    {
        if ($trip->status != "Requested") {
            return ApiResponse::errorResponse("Sorry, this Trip cannot be rejected", Response::HTTP_BAD_REQUEST);
        }
        $trip->update(['status' => "Rejected"]);
        return ApiResponse::successResponseWithData(new TripResource($trip), "Trip request was rejected successfully", Response::HTTP_ACCEPTED);
    }

    public function cancelTrip(Trip $trip, CancelTripRequest $request)
    {
        $data = $request->validated();
        $trip->update(['status' => "Canceled", 'cancel_location' => $data['cancel_location'], 'cancel_date_time' => Carbon::now(), 'canceled_by' => 'driver']);

        $rider = $trip->rider;
        newNotification(auth()->user()->id, $rider->user_id, $trip->id, "Trip", config('constants.trip.driver_cancel.title'), config('constants.trip.driver_cancel.message'), true);

        return ApiResponse::successResponseWithData(new TripResource($trip), "Trip was canceled successfully", Response::HTTP_ACCEPTED);
    }

    public function driverArrivedPickup(Trip $trip)
    {
        if ($trip->status != "Accepted") {
            return ApiResponse::errorResponse("Trip has not been accepted", Response::HTTP_BAD_REQUEST);
        }
        $trip->update(['status' => "Arrived", 'driver_arrival_time' => Carbon::now()]);

        $rider = $trip->rider;
        newNotification(auth()->user()->id, $rider->user_id, $trip->id, "Trip", config('constants.trip.driver_arrived.title'), config('constants.trip.driver_arrived.message'), true);

        return ApiResponse::successResponseWithData(new TripResource($trip), "Driver has arrived at the Pickup", Response::HTTP_ACCEPTED);
    }

    public function startTrip(Trip $trip, StartTripRequest $request)
    {
        $data = $request->validated();
        if ($trip->status == "Ongoing") {
            return ApiResponse::errorResponse("The Trip has started already", Response::HTTP_BAD_REQUEST);
        }
        if ($trip->status != "Arrived") {
            return ApiResponse::errorResponse("Sorry, this Trip cannot be started, until driver has arrived", Response::HTTP_BAD_REQUEST);
        }
        $trip->update(['start_time' => Carbon::now(), 'start_trip_location' => $data['start_trip_location'], 'status' => "Ongoing"]);
        return ApiResponse::successResponseWithData(new TripResource($trip), "Trip has Started", Response::HTTP_ACCEPTED);
    }

    public function endTrip(Trip $trip, EndTripRequest $request)
    {
        $data = $request->validated();
        if ($trip->status != "Ongoing") {
            return ApiResponse::errorResponse("Only Ongoing Trips can be ended", Response::HTTP_BAD_REQUEST);
        }
        $trip->update([
            'total_price' => $data['total_price'],
            'end_time' => Carbon::now(),
            'end_trip_location' => $data['end_trip_location'],
            'total_duration_spent' => Carbon::now()->diffInMinutes($trip['start_time']),
            'total_distance_covered' => $data['total_distance_covered'],
            'status' => "Completed"
        ]);

        //update driver's number of rides
        $driver = $trip->driver;
        $driver->update(['completed_rides' => $driver['completed_rides'] + 1, 'total_distance' => $driver['total_distance'] + $data['total_distance_covered']]);

        //reward driver for their performance
        $this->reward_driver_performance($driver, $trip->id);

        //update rider's number of rides
        $rider = $trip->rider;
        $rider->update(['completed_rides' => $rider['completed_rides'] + 1]);

        //notify the rider
        newNotification(auth()->user()->id, $rider->user_id, $trip->id, "Trip", config('constants.trip.complete.title'), config('constants.trip.complete.message'), true);

        return ApiResponse::successResponseWithData(new TripResource($trip), "Trip has been completed", Response::HTTP_OK);
    }

    public function confirmCashPayment(Trip $trip)
    {
        if ($trip->status != "Completed") {
            return ApiResponse::errorResponse("Sorry!, Trip must be completed before payment is confirmed", Response::HTTP_BAD_REQUEST);
        }
        $trip->update(['is_paid' => true]);
        return ApiResponse::successResponseWithData(new TripResource($trip), "Cash payment has been confirmed", Response::HTTP_OK);
    }

    public function reviewRider(User $user, ReviewRiderRequest $request)
    {
        $data = $request->validated();
        $driver = User::find(auth()->user()->id);
        $rider = $user->profile;
        $data['rider_id'] = $rider->id;
        $data['driver_user_id'] = $driver['id'];
        $data['reviewer'] = $driver['fullname'];

        $review = RiderReview::create($data);
        return ApiResponse::successResponseWithData(new RiderReviewResource($review), "Review was sent successfully", Response::HTTP_OK);
    }

    public function deleteTrip(Trip $trip)
    {
        if ($trip->status == "Requested" || $trip->status == "Accepeted" || $trip->status == "Ongoing") {
            return ApiResponse::errorResponse("Trip cannot be deleted", Response::HTTP_BAD_REQUEST);
        }
        $trip->delete();
        return ApiResponse::successResponse("Trip has been removed successfully", Response::HTTP_OK);
    }


    private function reward_driver_performance($driver, $tripID): void
    {
        $eligibility = $driver['completed_rides'] % env('DRIVER_PERFORMANCE_NO_RIDES');
        if ($eligibility == 0) {
            $driver->user->wallet->update([
                'withdrawable_amount' => $driver->user->wallet->withdrawable_amount + env('DRIVER_PERFORMANCE_REWARD')
            ]);

            //notify driver in app
            newNotification(auth()->user()->id, $driver->user_id, $tripID, "Trip", config('constants.wallet.performance.title'), config('constants.wallet.performance.message'), true);

            //notify driver via mail
            Notification::route('mail', $driver->user->email)->notify((new PerformanceRewardNotification($driver->user->firstname, $driver['completed_rides'])));
        }
    }
}
