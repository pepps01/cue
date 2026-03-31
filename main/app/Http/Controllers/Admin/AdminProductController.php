<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Http\Requests\UpdateProductImageRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateSpecsRequest;
use App\Http\Resources\ProductFeatureResource;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductSpecificationResource;
use App\Models\Brand;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductFeature;
use App\Models\ProductImage;
use App\Models\ProductSpecification;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminProductController extends Controller
{
    use ApiResponse;

    public function getAllProducts()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        $productResource = ProductResource::collection($products);
        return ApiResponse::successResponseWithData($productResource, "All Products Retrieved", Response::HTTP_OK);
    }

    public function productsByCategory(ProductCategory $category)
    {
        $products = Product::where('category_id', $category->id)->where('is_active', true)->orderBy('created_at', 'DESC')->get();
        $productResource = ProductResource::collection($products);
        return ApiResponse::successResponseWithData($productResource, "All Products from " . $category->name . " category retrieved ", Response::HTTP_ACCEPTED);
    }

    public function productsByMerchant(Merchant $merchant)
    {
        $products = Product::where('merchant_id', $merchant->id)->orderBy('created_at', 'DESC')->get();
        $productResource = ProductResource::collection($products);
        return ApiResponse::successResponseWithData($productResource, "Products by merchant", Response::HTTP_ACCEPTED);
    }

    public function singleProduct(Product $product)
    {
        $productResource = new ProductResource($product);
        return ApiResponse::successResponseWithData($productResource, "Single Product Retrived", Response::HTTP_ACCEPTED);
    }

    public function createProduct(CreateProductRequest $request, Merchant $merchant)
    {
        $data = $request->validated();
        $data['serial'] = uniqueRandomChar('products', 'serial', 8);
        $data['user_id'] = $merchant['user_id'];
        $data['merchant_id'] = $merchant['id'];

        if ($data['discount_available'] == "Yes") {
            $data['discount_amount'] = $data['price'] - $data['price'] * $data['discount_percentage'] / 100;
        } else {
            $data['discount_amount'] = $data['price'];
        }

        $product = Product::create($data);
        $category = ProductCategory::where('id', $data['category_id'])->first();
        $createBrand = Brand::updateOrCreate(['name' => $data['brand'], 'category' => $category['name']]);

        $productResource = new ProductResource($product);
        saveAdminActivityLog("product_created", "Product", $product->id);
        return ApiResponse::successResponseWithData($productResource, "New product created successfully", Response::HTTP_CREATED);
    }

    public function updateProduct(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        //if brand and category were updated
        if (isset($data['brand']) && isset($data['category_id'])) {
            $category = ProductCategory::where('id', $data['category_id'])->first();
            $createBrand = Brand::updateOrCreate(['name' => $data['brand'], 'category' => $category['name']]);
        }
        
        // if the price value was updated
        if (isset($data['price'])) {
            if ($data['discount_available'] == "Yes") {
                $data['discount_amount'] = $data['price'] - $data['price'] * $data['discount_percentage'] / 100;
            } else {
                $data['discount_amount'] = $data['price'];
            }
        }
        // if the price value wasn't updated but the discount percentage value was updated
        else {
            if (isset($data['discount_available'])) {
                if ($data['discount_available'] == "Yes") {
                    $data['discount_amount'] = $product['price'] - $product['price'] * $data['discount_percentage'] / 100;
                } else {
                    $data['discount_amount'] = $product['price'];
                }
            }
        }

        $product->update($data);
        $productResource = new ProductResource($product);
        saveAdminActivityLog("product_updated", "Product", $product->id);
        return ApiResponse::successResponseWithData($productResource, "Product Updated Successfully", Response::HTTP_ACCEPTED);
    }

    public function addProductFeature(UpdateFeatureRequest $request, Product $product)
    {
        $data = $request->validated();
        foreach ($data['feature'] as $item) {
            $feature = ProductFeature::updateOrCreate(['feature' => $item, 'product_id' => $product->id]);
            saveAdminActivityLog("product_feature_added", "ProductFeature", $feature->id);
        }
        $productResource = new ProductResource($product);
        return ApiResponse::successResponseWithData($productResource, "Product Fetures Added successfully", Response::HTTP_CREATED);
    }

    public function editProductFeature(ProductFeature $feature, Request $request)
    {
        $data = $request->validate([
            'feature_name' => ['required', 'string']
        ]);
        $feature->update(['feature' => $data['feature_name']]);
        $featureResource = new ProductFeatureResource($feature);
        saveAdminActivityLog("product_feature_updated", "ProductFeature", $feature->id);
        return ApiResponse::successResponseWithData($featureResource, "Product Fetures Updated successfully", Response::HTTP_OK);
    }

    public function removeProductFeature(ProductFeature $feature)
    {
        $feature->delete();
        saveAdminActivityLog("product_feature_deleted", "ProductFeature", $feature->id);
        return ApiResponse::successResponse("Product Feture Removed successfully", Response::HTTP_OK);
    }

    public function addProductSpecs(UpdateSpecsRequest $request, Product $product)
    {
        if ($product['is_active'] == false) {
            return ApiResponse::errorResponse('Product is not active', Response::HTTP_BAD_REQUEST);
        }
        $data = $request->validated();
        foreach ($data['spec'] as $spec) {
            $spec = ProductSpecification::updateOrCreate(['product_id' => $product->id, 'title' => $spec['title'], 'value' => $spec['value']]);
            saveAdminActivityLog("product_spec_added", "ProductSpecification", $spec->id);
        }
        $productResource = new ProductResource($product);
        return ApiResponse::successResponseWithData($productResource, "Product Specifications Added successfully", Response::HTTP_CREATED);
    }

    public function editProductSpec(ProductSpecification $spec, Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'value' => ['required', 'string']
        ]);
        $spec->update($data);
        $specResource = new ProductSpecificationResource($spec);
        saveAdminActivityLog("product_spec_updated", "ProductSpecification", $spec->id);
        return ApiResponse::successResponseWithData($specResource, "Product Specification Updated successfully", Response::HTTP_OK);
    }

    public function removeProductSpec(ProductSpecification $spec)
    {
        $spec->delete();
        saveAdminActivityLog("product_spec_deleted", "ProductSpecification", $spec->id);
        return ApiResponse::successResponse("Product Specification Removed successfully", Response::HTTP_OK);
    }

    public function addProductImages(UpdateProductImageRequest $request, Product $product)
    {
        $data = $request->validated();
        foreach ($data['image'] as $image) {
            $imageToStore = pushFileToStorage($image, 'products');
            $image = ProductImage::create(['product_id' => $product->id, 'image' => $imageToStore]);
            saveAdminActivityLog("product_image_added", "ProductImage", $image->id);
        }
        $productResource = new ProductResource($product);
        return ApiResponse::successResponseWithData($productResource, "Product Images uploaded successfully", Response::HTTP_CREATED);
    }

    public function editProductImage(ProductImage $image, Request $request)
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:5000']
        ]);
        $imageToStore = pushFileToStorage($data['image'], 'products');
        $image->update(['image' => $imageToStore]);

        $imageResource = new ProductImageResource($image);
        saveAdminActivityLog("product_image_updated", "ProductImage", $image->id);
        return ApiResponse::successResponseWithData($imageResource, "Product Image updated successfully", Response::HTTP_OK);
    }

    public function removeProductImage(ProductImage $image)
    {
        $image->delete();
        saveAdminActivityLog("product_image_deleted", "ProductImage", $image->id);
        return ApiResponse::successResponse("Product Image Removed successfully", Response::HTTP_OK);
    }

    public function setPrimaryImage(Product $product, ProductImage $image)
    {
        $defaultImage = ProductImage::where('product_id', $product->id)->where('is_primary', 1)->first();
        if ($defaultImage) {
            $defaultImage->update(['is_primary' => false]);
        }
        $image->update(['is_primary' => true]);
        $productResource = new ProductResource($product);
        saveAdminActivityLog("set_product_primary_image", "ProductImage", $image->id);
        return ApiResponse::successResponseWithData($productResource, "Primary Image updated Successfully", Response::HTTP_OK);
    }

    public function deactivateProduct(Product $product)
    {
        if ($product['is_active'] == false) {
            return ApiResponse::errorResponse('Product is not active', Response::HTTP_BAD_REQUEST);
        }
        $product->update([
            'is_active' => false
        ]);
        saveAdminActivityLog("product_deactivate", "Product", $product->id);
        return ApiResponse::successResponse("Product has been deactivated", Response::HTTP_OK);
    }

    public function activateProduct(Product $product)
    {
        if ($product['is_active'] == true) {
            return ApiResponse::errorResponse('Product is already active', Response::HTTP_ALREADY_REPORTED);
        }
        $product->update([
            'is_active' => true
        ]);
        $productResource = new ProductResource($product);
        saveAdminActivityLog("product_activate", "Product", $product->id);
        return ApiResponse::successResponseWithData($productResource, "Product has been activated", Response::HTTP_CREATED);
    }

    public function deletedProduct(Product $product)
    {
        $product->delete();
        saveAdminActivityLog("product_deleted", "Product", $product->id);
        return ApiResponse::successResponse("Product was deleted successfully", Response::HTTP_OK);
    }
}
