<?php

namespace App\Http\Controllers\Cue;

use App\Http\Controllers\Controller;
use App\Http\Requests\FavouriteAddressRequest;
use App\Http\Requests\UpdateRiderRequest;
use App\Http\Resources\RiderFavLocationResource;
use App\Http\Resources\RiderReviewResource;
use App\Http\Resources\UserResource;
use App\Models\Rider;
use App\Models\RiderFavLocation;
use App\Models\RiderReview;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class RiderController extends Controller
{
    use ApiResponse;

    public function updateRider(UpdateRiderRequest $request)
    {
        $user = User::find(auth()->user()->id);
        $rider = $user->profile;
        $data = $request->validated();

        if ($request->has('home_location')) {
            $home_geocode = geocode_api($data['home_location']);
            $data['home_lat'] = $home_geocode['lat'];
            $data['home_long'] = $home_geocode['long'];
            $data['home_place_id'] = $home_geocode['place_id'];
        }
        if ($request->has('work_location')) {
            $work_geocode = geocode_api($data['work_location']);
            $data['work_lat'] = $work_geocode['lat'];
            $data['work_long'] = $work_geocode['long'];
            $data['work_place_id'] = $work_geocode['place_id'];
        }
        $user->update($data);
        $rider->update($data);

        return ApiResponse::successResponseWithData(new UserResource($user), "Update was Successfull", Response::HTTP_OK);
    }

    public function favouriteAddress(FavouriteAddressRequest $request)
    {
        $data = $request->validated();
        $rider = auth()->user()->profile;
        $fav_geocode = geocode_api($data['fav_location']);
        $data['fav_lat'] = $fav_geocode['lat'];
        $data['fav_long'] = $fav_geocode['long'];
        $data['fav_place_id'] = $fav_geocode['place_id'];
        $data['rider_id'] = $rider->id;

        $fav = RiderFavLocation::updateOrCreate($data);
        return ApiResponse::successResponseWithData(new RiderFavLocationResource($fav), "Update was Successfull", Response::HTTP_OK);
    }

    public function removeFavouriteAddress(RiderFavLocation $location)
    {
        $location->delete();
        return ApiResponse::successResponse("Location removed Successfully", Response::HTTP_OK);
    }

    public function getRiderReviews(Rider $rider)
    {
        $reviews = RiderReview::where('rider_id', $rider->id)->orderBy('created_at', 'DESC')->get();
        $noOfRatings = $reviews->count();
        $average = $reviews->avg('rating');

        $stats = [
            'numberOfRatings' => $noOfRatings,
            'average' => $average,
            'noOfFive' => self::count_reviews($rider, 5),
            'noOfFour' => self::count_reviews($rider, 4),
            'noOfThree' => self::count_reviews($rider, 3),
            'noOfTwo' => self::count_reviews($rider, 2),
            'noOfOne' => self::count_reviews($rider, 1),
        ];
        $reviewResource = RiderReviewResource::collection($reviews);
        return ApiResponse::successResponseWithMetadata($reviewResource, $stats, "Rider Reviews with Statistics", Response::HTTP_OK);
    }


    protected function count_reviews($rider, $value)
    {
        return RiderReview::where('rider_id', $rider->id)->where('rating', $value)->count();
    }
}
