<?php

namespace App\Http\Controllers\Flip;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceImageRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\ServiceCategoryResource;
use App\Http\Resources\ServiceImageResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ServiceReviewResource;
use App\Models\Merchant;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceImage;
use App\Models\ServiceReview;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    public function allCategories()
    {
        $categories = ServiceCategory::where('is_active', true)->get();
        $categoriesResource = ServiceCategoryResource::collection($categories);
        return ApiResponse::successResponseWithData($categoriesResource, "All Service Categories retrieved", Response::HTTP_OK);
    }

    public function allServices(Request $request)
    {
        $services = Service::where('is_active', true)->filter($request->all())->orderBy('created_at', 'DESC')->get();
        $serviceResource = ServiceResource::collection($services);
        return ApiResponse::successResponseWithData($serviceResource, "All Services retrieved", Response::HTTP_OK);
    }

    public function serviceByCategory(ServiceCategory $category)
    {
        $services = Service::where('category_id', $category->id)->where('is_active', true)->orderBy('created_at', 'DESC')->get();
        $serviceResource = ServiceResource::collection($services);
        return ApiResponse::successResponseWithData($serviceResource, "All Services of the " . $category->name . " retrieved", Response::HTTP_OK);
    }

    public function serviceByLoggedMerchant()
    {
        $services = Service::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        $serviceResource = ServiceResource::collection($services);
        return ApiResponse::successResponseWithData($serviceResource, "Services by logged in merchant", Response::HTTP_ACCEPTED);
    }

    public function singleService(Service $service)
    {
        if ($service['is_active'] == false) {
            return ApiResponse::errorResponse('Service is not active', Response::HTTP_BAD_REQUEST);
        }
        $serviceResource = new ServiceResource($service);
        return ApiResponse::successResponseWithData($serviceResource, "Single Service Retrived", Response::HTTP_ACCEPTED);
    }

    public function serviceByMerchant(Merchant $merchant)
    {
        $services = Service::where('merchant_id', $merchant->id)->where('is_active', true)->orderBy('created_at', 'DESC')->get();
        $serviceResource = ServiceResource::collection($services);
        return ApiResponse::successResponseWithData($serviceResource, "Services by merchant", Response::HTTP_ACCEPTED);
    }

    public function createService(CreateServiceRequest $request)
    {
        $userID = auth()->user()->id;
        $merchant = Merchant::where('user_id', $userID)->first();

        $data = $request->validated();
        $data['serial'] = uniqueRandomChar('services', 'serial', 8);
        $data['user_id'] = $userID;
        $data['merchant_id'] = $merchant['id'];

        $service = Service::create($data);
        $serviceResource = new ServiceResource($service);
        return ApiResponse::successResponseWithData($serviceResource, "New service was created Successfully", Response::HTTP_CREATED);
    }

    public function updateService(Service $service, UpdateServiceRequest $request)
    {
        if ($service['is_active'] == false) {
            return ApiResponse::errorResponse('Product is not active', Response::HTTP_BAD_REQUEST);
        }
        $data = $request->validated();
        $service->update($data);

        $serviceResource = new ServiceResource($service);
        return ApiResponse::successResponseWithData($serviceResource, "Service was updated successfully", Response::HTTP_CREATED);
    }

    public function addServiceImages(Service $service, UpdateServiceImageRequest $request)
    {
        if ($service['is_active'] == false) {
            return ApiResponse::errorResponse('Service is not active', Response::HTTP_BAD_REQUEST);
        }
        $data = $request->validated();
        foreach ($data['image'] as $image) {
            $imageToStore = pushFileToStorage($image, 'services');
            ServiceImage::create(['service_id' => $service->id, 'image' => $imageToStore]);
        }
        $serviceResource = new ServiceResource($service);
        return ApiResponse::successResponseWithData($serviceResource, "Images uploaded Successfully", Response::HTTP_CREATED);
    }

    public function editServiceImage(ServiceImage $image, Request $request)
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:5000']
        ]);
        $imageToStore = pushFileToStorage($data['image'], 'services');
        $image->update(['image' => $imageToStore]);

        $imageResource = new ServiceImageResource($image);
        return ApiResponse::successResponseWithData($imageResource, "Images updated Successfully", Response::HTTP_CREATED);
    }

    public function removeServiceImage(ServiceImage $image)
    {
        $image->delete();
        return ApiResponse::successResponse("Service Image Removed successfully", Response::HTTP_OK);
    }

    public function setPrimaryImage(Service $service, ServiceImage $image)
    {
        $defaultImage = ServiceImage::where('service_id', $service->id)->where('is_primary', 1)->first();
        if ($defaultImage) {
            $defaultImage->update(['is_primary' => false]);
        }
        $image->update(['is_primary' => true]);
        $serviceResource = new ServiceResource($service);
        return ApiResponse::successResponseWithData($serviceResource, "Primary Image updated Successfully", Response::HTTP_OK);
    }

    public function deactivateService(Service $service)
    {
        if ($service['is_active'] == false) {
            return ApiResponse::errorResponse('Service is not active', Response::HTTP_BAD_REQUEST);
        }
        $service->update([
            'is_active' => false
        ]);
        return ApiResponse::successResponse("Service has been deactivated", Response::HTTP_OK);
    }

    public function activateService(Service $service)
    {
        if ($service['is_active'] == true) {
            return ApiResponse::errorResponse('Service is already active', Response::HTTP_BAD_REQUEST);
        }
        $service->update([
            'is_active' => true
        ]);
        return ApiResponse::successResponse("Service has been activated", Response::HTTP_OK);
    }

    public function myServices()
    {
        $services = Service::where('user_id', auth()->user()->id)->where('is_active', true)->orderBy('created_at', 'DESC')->get();
        $serviceResource = ServiceResource::collection($services);
        return ApiResponse::successResponseWithData($serviceResource, "All my Services retrieved", Response::HTTP_ACCEPTED);
    }

    public function getServiceReviews(Service $service)
    {
        $reviews = ServiceReview::where('service_id', $service->id)->orderBy('created_at', 'DESC')->get();
        $noOfRatings = $reviews->count();
        $average = $reviews->avg('rating');

        $stats = [
            'numberOfRatings' => $noOfRatings,
            'average' => $average,
            'noOfFive' => self::count_reviews($service, 5),
            'noOfFour' => self::count_reviews($service, 4),
            'noOfThree' => self::count_reviews($service, 3),
            'noOfTwo' => self::count_reviews($service, 2),
            'noOfOne' => self::count_reviews($service, 1),
        ];
        $reviewResource = ServiceReviewResource::collection($reviews);
        return ApiResponse::successResponseWithMetadata($reviewResource, $stats, "Service Revies with Statistics", Response::HTTP_OK);
    }


    protected function count_reviews($service, $value)
    {
        return ServiceReview::where('service_id', $service->id)->where('rating', $value)->count();
    }
}
