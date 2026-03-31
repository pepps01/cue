<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceImageRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\ServiceImageResource;
use App\Http\Resources\ServiceResource;
use App\Models\Merchant;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminServiceController extends Controller
{
    use ApiResponse;

    public function getAllServices()
    {
        $services = Service::orderBy('created_at', 'DESC')->get();
        $serviceResource = ServiceResource::collection($services);
        return ApiResponse::successResponseWithData($serviceResource, "All Services retrieved", Response::HTTP_OK);
    }

    public function getSingleServices(Service $service)
    {
        $serviceResource = new ServiceResource($service);
        return ApiResponse::successResponseWithData($serviceResource, "Single Service retrieved", Response::HTTP_OK);
    }

    public function servicesByMerchant(Merchant $merchant)
    {
        $services = Service::where('merchant_id', $merchant['id'])->orderBy('created_at', 'DESC')->get();
        $serviceResource = ServiceResource::collection($services);
        return ApiResponse::successResponseWithData($serviceResource, "Service Resources retrieved", Response::HTTP_OK);
    }

    public function createService(CreateServiceRequest $request, Merchant $merchant)
    {
        $data = $request->validated();
        $data['serial'] = uniqueRandomChar('services', 'serial', 8);
        $data['user_id'] = $merchant['user_id'];
        $data['merchant_id'] = $merchant['id'];

        $service = Service::create($data);
        $serviceResource = new ServiceResource($service);
        saveAdminActivityLog("service_created", "Service", $service->id);
        return ApiResponse::successResponseWithData($serviceResource, "New service was created Successfully", Response::HTTP_CREATED);
    }

    public function updateService(Service $service, UpdateServiceRequest $request)
    {
        $data = $request->validated();
        $service->update($data);

        $serviceResource = new ServiceResource($service);
        saveAdminActivityLog("service_updated", "Service", $service->id);
        return ApiResponse::successResponseWithData($serviceResource, "Service was updated successfully", Response::HTTP_CREATED);
    }

    public function addServiceImages(Service $service, UpdateServiceImageRequest $request)
    {
        $data = $request->validated();
        foreach ($data['image'] as $image) {
            $imageToStore = pushFileToStorage($image, 'services');
            $image = ServiceImage::create(['service_id' => $service->id, 'image' => $imageToStore]);
            saveAdminActivityLog("service_image_added", "ServiceImage", $image->id);
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
        saveAdminActivityLog("service_image_updated", "ServiceImage", $image->id);
        return ApiResponse::successResponseWithData($imageResource, "Images updated Successfully", Response::HTTP_CREATED);
    }

    public function removeServiceImage(ServiceImage $image)
    {
        $image->delete();
        saveAdminActivityLog("service_image_deleted", "ServiceImage", $image->id);
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
        saveAdminActivityLog("set_service_primary_image", "ServiceImage", $image->id);
        return ApiResponse::successResponseWithData($serviceResource, "Primary Image updated Successfully", Response::HTTP_OK);
    }

    public function deactivateService(Service $service)
    {
        $service->update([
            'is_active' => false
        ]);
        saveAdminActivityLog("service_deactivated", "Service", $service->id);
        return ApiResponse::successResponse("Service has been deactivated", Response::HTTP_OK);
    }

    public function activateService(Service $service)
    {
        $service->update([
            'is_active' => true
        ]);
        $serviceResource = new ServiceResource($service);
        saveAdminActivityLog("service_activated", "Service", $service->id);
        return ApiResponse::successResponseWithData($serviceResource, "Service has been activated", Response::HTTP_OK);
    }

    public function deleteService(Service $service)
    {
        $service->delete();
        saveAdminActivityLog("service_deleted", "Service", $service->id);
        return ApiResponse::successResponse("Service has been deleted successfully", Response::HTTP_OK);
    }
}
