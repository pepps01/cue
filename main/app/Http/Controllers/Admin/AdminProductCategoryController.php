<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Resources\ProductCategoryResource;
use Symfony\Component\HttpFoundation\Response;

class AdminProductCategoryController extends Controller
{
    use ApiResponse;

    public function getAllProductCategories()
    {
        $categories = ProductCategory::orderBy('created_at', 'DESC')->get();
        $categoryResource = ProductCategoryResource::collection($categories);
        return ApiResponse::successResponseWithData($categoryResource, "All Product Categories retrieved", Response::HTTP_OK);
    }

    public function getSingleProductCategories(ProductCategory $category)
    {
        $categoryResource = new ProductCategoryResource($category);
        return ApiResponse::successResponseWithData($categoryResource, "Single category retrieved", Response::HTTP_OK);
    }

    public function createProductCategory(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data['image'] = pushFileToStorage($image, 'product-category');
        }
        $category = ProductCategory::create($data);
        $categoryResource = new ProductCategoryResource($category);
        saveAdminActivityLog("category_created", "ProductCategory", $category->id);
        return ApiResponse::successResponseWithData($categoryResource, "New category created", Response::HTTP_CREATED);
    }

    public function updateProductCategory(ProductCategory $category, Request $request)
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5000']
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data['image'] = pushFileToStorage($image, 'product-category');
        }
        $category->update($data);
        $categoryResource = new ProductCategoryResource($category);
        saveAdminActivityLog("category_updated", "ProductCategory", $category->id);
        return ApiResponse::successResponseWithData($categoryResource, "Selected category updated", Response::HTTP_OK);
    }

    public function deactivateCategory(ProductCategory $category)
    {
        if ($category['is_active'] == false) {
            return ApiResponse::errorResponse('Category is not active', Response::HTTP_BAD_REQUEST);
        }
        $category->update([
            'is_active' => false
        ]);
        saveAdminActivityLog("category_deactivated", "ProductCategory", $category->id);
        return ApiResponse::successResponse("Product Category has been deactivated", Response::HTTP_OK);
    }

    public function activateCategory(ProductCategory $category)
    {
        if ($category['is_active'] == true) {
            return ApiResponse::errorResponse('Category is already active', Response::HTTP_BAD_REQUEST);
        }
        $category->update([
            'is_active' => true
        ]);
        $categoryResource = new ProductCategoryResource($category);
        saveAdminActivityLog("category_activated", "ProductCategory", $category->id);
        return ApiResponse::successResponseWithData($categoryResource, "Product Category has been activated", Response::HTTP_OK);
    }

    public function deleteCategory(ProductCategory $category)
    {
        $category->delete();
        saveAdminActivityLog("category_deleted", "ProductCategory", $category->id);
        return ApiResponse::successResponse("Product Category has been deleted", Response::HTTP_OK);
    }
}
