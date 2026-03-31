<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Resources\ServiceCategoryResource;
use App\Models\ServiceCategory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminServiceCategoryController extends Controller
{
    use ApiResponse;

    public function getAllServiceCategories()
    {
        $categories = ServiceCategory::orderBy('created_at', 'DESC')->get();
        $categoryResource = ServiceCategoryResource::collection($categories);
        return ApiResponse::successResponseWithData($categoryResource, "All Service categories retrieved", Response::HTTP_OK);
    }

    public function getSingleServiceCategory(ServiceCategory $category)
    {
        $categoryResource = new ServiceCategoryResource($category);
        return ApiResponse::successResponseWithData($categoryResource, "Single service category retrieved", Response::HTTP_OK);
    }

    public function createServiceCategory(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data['image'] = pushFileToStorage($image, 'service-category');
        }
        $category = ServiceCategory::create($data);
        $categoryResource = new ServiceCategoryResource($category);
        saveAdminActivityLog("category_created", "ServiceCategory", $category->id);
        return ApiResponse::successResponseWithData($categoryResource, "New category created", Response::HTTP_CREATED);
    }

    public function updateServiceCategory(Request $request, ServiceCategory $category)
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5000']
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data['image'] = pushFileToStorage($image, 'service-category');
        }
        $category->update($data);
        $categoryResource = new ServiceCategoryResource($category);
        saveAdminActivityLog("category_updated", "ServiceCategory", $category->id);
        return ApiResponse::successResponseWithData($categoryResource, "Selected category updated", Response::HTTP_OK);
    }

    public function deactivateCategory(ServiceCategory $category)
    {
        if ($category['is_active'] == false) {
            return ApiResponse::errorResponse('Category is not active', Response::HTTP_BAD_REQUEST);
        }
        $category->update([
            'is_active' => false
        ]);
        saveAdminActivityLog("category_deactivated", "ServiceCategory", $category->id);
        return ApiResponse::successResponse("Service Category has been deactivated", Response::HTTP_OK);
    }

    public function activateCategory(ServiceCategory $category)
    {
        if ($category['is_active'] == true) {
            return ApiResponse::errorResponse('Category is already active', Response::HTTP_BAD_REQUEST);
        }
        $category->update([
            'is_active' => true
        ]);
        $categoryResource = new ServiceCategoryResource($category);
        saveAdminActivityLog("category_activated", "ServiceCategory", $category->id);
        return ApiResponse::successResponseWithData($categoryResource, "Service Category has been activated", Response::HTTP_OK);
    }

    public function deleteCategory(ServiceCategory $category)
    {
        $category->delete();
        saveAdminActivityLog("category_deleted", "ServiceCategory", $category->id);
        return ApiResponse::successResponse("Service Category has been deleted", Response::HTTP_OK);
    }
}
