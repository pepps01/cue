<?php

namespace App\Http\Controllers\CueVendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMealRequest;
use App\Http\Requests\UpdateMealRequest;
use App\Http\Resources\MealResource;
use App\Http\Resources\VendorResource;
use App\Models\CueChowMeal;
use App\Models\CueChowVendor;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MealController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $meals = CueChowMeal::orderBy('created_at', 'DESC')->filter($request->all())->paginate($request->limit);
        return ApiResponse::successResponseWithData(MealResource::collection($meals)->response()->getData(), "All meals retrieved", Response::HTTP_OK);
    }

    public function store(CreateMealRequest $request)
    {
        $data = $request->validated();
        $images = [];
        foreach ($data['image'] as $image) {
            $imageToStore = pushFileToStorage($image, 'meals');
            $images[] = $imageToStore;
        }
        $data['image'] = json_encode($images);
        $data['user_id'] = auth()->user()->id;
        $data['vendor_id'] = auth()->user()->profile->id;
        $meal = CueChowMeal::create($data);
        return ApiResponse::successResponseWithData(new MealResource($meal), "Meal Created Successfully", Response::HTTP_CREATED);
    }

    public function update(CueChowMeal $meal, UpdateMealRequest $request)
    {
        $data = $request->validated();
        $images = [];
        if (isset($data['image'])) {
            foreach ($data['image'] as $image) {
                $imageToStore = pushFileToStorage($image, 'meals');
                $images[] = $imageToStore;
            }
        }
        $data['image'] = json_encode($images);
        $meal->update($data);
        return ApiResponse::successResponseWithData(new MealResource($meal), "Update was successfull", Response::HTTP_OK);
    }

    public function myMeals()
    {
        $meals = CueChowMeal::where('user_id', auth()->user()->id)->get();
        return ApiResponse::successResponseWithData(MealResource::collection($meals), "All my meals retrieved", Response::HTTP_OK);
    }

    public function show(CueChowMeal $meal)
    {
        return ApiResponse::successResponseWithData(new MealResource($meal), "Successfull", Response::HTTP_OK);
    }

    public function setStockStatus(CueChowMeal $meal, $status)
    {
        $meal->update([
            'is_in_stock' => $status == 'true' ? 1 : 0
        ]);
        return ApiResponse::successResponse("Update was successfull", Response::HTTP_OK);
    }

    public function delete(CueChowMeal $meal)
    {
        $meal->delete();
        return ApiResponse::successResponse("Meal Deleted Successfully", Response::HTTP_OK);
    }

    public function getRestaurants(Request $request)
    {
        $restaurants = CueChowVendor::where('business_type', 'restaurant')->paginate($request->limit);
        return ApiResponse::successResponseWithData(VendorResource::collection($restaurants)->response()->getData(), "Successfull", Response::HTTP_OK);
    }
}
