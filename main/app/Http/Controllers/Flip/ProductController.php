<?php

namespace App\Http\Controllers\Flip;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateFeatureRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\CreateProductReviewRequest;
use App\Http\Requests\UpdateProductImageRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateSpecsRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ProductFeatureResource;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductReviewResource;
use App\Http\Resources\ProductSpecificationResource;
use App\Models\Brand;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductFeature;
use App\Models\ProductImage;
use App\Models\ProductReview;
use App\Models\ProductSpecification;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function allCategories()
    {
        $categories = ProductCategory::where('is_active', true)->orderBy('created_at', 'DESC')->get();
        $categoriesResource = ProductCategoryResource::collection($categories);
        return ApiResponse::successResponseWithData($categoriesResource, "All Product Categories retrieved", Response::HTTP_OK);
    }

    public function allProducts(Request $request)
    {
        $products = Product::where('is_active', true)->filter($request->all())->orderBy('created_at', 'DESC')->get();
        $productResource = ProductResource::collection($products);
        return ApiResponse::successResponseWithData($productResource, "All Products Retrived", Response::HTTP_ACCEPTED);
    }

    public function productByLoggedMerchant()
    {
        $products = Product::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        $productResource = ProductResource::collection($products);
        return ApiResponse::successResponseWithData($productResource, "Products by logged in merchant", Response::HTTP_ACCEPTED);
    }

    public function singleProduct(Product $product)
    {
        if ($product['is_active'] == false) {
            return ApiResponse::errorResponse('Product is not active', Response::HTTP_BAD_REQUEST);
        }
        $productResource = new ProductResource($product);
        return ApiResponse::successResponseWithData($productResource, "Single Product Retrived", Response::HTTP_ACCEPTED);
    }

    public function productsByCategory(ProductCategory $category)
    {
        $products = Product::where('category_id', $category->id)->where('is_active', true)->orderBy('created_at', 'DESC')->get();
        $productResource = ProductResource::collection($products);
        return ApiResponse::successResponseWithData($productResource, "All Products from " . $category->name . " category retrieved ", Response::HTTP_ACCEPTED);
    }

    //products of the non-logged in merchant (specified by ID)
    public function productByMerchant(Merchant $merchant)
    {
        $products = Product::where('merchant_id', $merchant->id)->where('is_active', true)->orderBy('created_at', 'DESC')->get();
        $productResource = ProductResource::collection($products);
        return ApiResponse::successResponseWithData($productResource, "Products by merchant", Response::HTTP_ACCEPTED);
    }

    public function getAllBrands()
    {
        $brands = Brand::orderBy('name')->get();
        $brandResource = BrandResource::collection($brands);
        return ApiResponse::successResponseWithData($brandResource, "All brands retrieved", Response::HTTP_OK);
    }

    public function getSingleBrand(Brand $brand)
    {
        $brandResource = new BrandResource($brand);
        return ApiResponse::successResponseWithData($brandResource, "Single Brand Reteived", Response::HTTP_OK);
    }

    public function getBrandsByCategory(ProductCategory $category)
    {
        $brands = Brand::where('category', 'LIKE', $category->name)->orderBy('name')->get();
        $brandResource = BrandResource::collection($brands);
        return ApiResponse::successResponseWithData($brandResource, "All brands that belongs to the " . $category->name . " category", Response::HTTP_OK);
    }

    public function getProductByBrand(Brand $brand)
    {
        $products = Product::where('brand', 'LIKE', $brand->name)->orderBy('created_at', 'DESC')->get();
        $productResource = ProductResource::collection($products);
        return ApiResponse::successResponseWithData($productResource, "All products of the " . $brand->name . " brand retrieved", Response::HTTP_OK);
    }

    public function createProduct(CreateProductRequest $request)
    {
        $userID = auth()->user()->id;
        $merchant = Merchant::where('user_id', $userID)->first();

        $data = $request->validated();
        $data['serial'] = uniqueRandomChar('products', 'serial', 8);
        $data['user_id'] = $userID;
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
        return ApiResponse::successResponseWithData($productResource, "New product created successfully", Response::HTTP_CREATED);
    }

    public function updateProduct(UpdateProductRequest $request, Product $product)
    {
        if ($product['is_active'] == false) {
            return ApiResponse::errorResponse('Product is not active', Response::HTTP_BAD_REQUEST);
        }

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
        return ApiResponse::successResponseWithData($productResource, "Product Updated Successfully", Response::HTTP_ACCEPTED);
    }

    public function addProductFeature(UpdateFeatureRequest $request, Product $product)
    {
        if ($product['is_active'] == false) {
            return ApiResponse::errorResponse('Product is not active', Response::HTTP_BAD_REQUEST);
        }
        $data = $request->validated();
        $features = ProductFeature::where('product_id', $product->id);
        if ($features->count() > 0) {
            $features->delete();
        }
        foreach ($data['feature'] as $item) {
            ProductFeature::updateOrCreate(['feature' => $item, 'product_id' => $product->id]);
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
        return ApiResponse::successResponseWithData($featureResource, "Product Fetures Updated successfully", Response::HTTP_OK);
    }

    public function removeProductFeature(ProductFeature $feature)
    {
        $feature->delete();
        return ApiResponse::successResponse("Product Feture Removed successfully", Response::HTTP_OK);
    }

    public function addProductSpecs(UpdateSpecsRequest $request, Product $product)
    {
        if ($product['is_active'] == false) {
            return ApiResponse::errorResponse('Product is not active', Response::HTTP_BAD_REQUEST);
        }
        $data = $request->validated();
        foreach ($data['spec'] as $spec) {
            ProductSpecification::updateOrCreate(['product_id' => $product->id, 'title' => $spec['title'], 'value' => $spec['value']]);
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
        return ApiResponse::successResponseWithData($specResource, "Product Specification Updated successfully", Response::HTTP_OK);
    }

    public function removeProductSpec(ProductSpecification $spec)
    {
        $spec->delete();
        return ApiResponse::successResponse("Product Specification Removed successfully", Response::HTTP_OK);
    }

    public function addProductImages(UpdateProductImageRequest $request, Product $product)
    {
        if ($product['is_active'] == false) {
            return ApiResponse::errorResponse('Product is not active', Response::HTTP_BAD_REQUEST);
        }
        $data = $request->validated();
        foreach ($data['image'] as $image) {
            $imageToStore = pushFileToStorage($image, 'products');

            ProductImage::create(['product_id' => $product->id, 'image' => $imageToStore]);
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
        return ApiResponse::successResponseWithData($imageResource, "Product Image updated successfully", Response::HTTP_OK);
    }

    public function removeProductImage(ProductImage $image)
    {
        $image->delete();
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
        return ApiResponse::successResponseWithData($productResource, "Product has been activated", Response::HTTP_CREATED);
    }

    //products for logged in merchant
    public function myProducts()
    {
        $products = Product::where('user_id', auth()->user()->id)->where('is_active', true)->orderBy('created_at', 'DESC')->get();
        $productResource = ProductResource::collection($products);
        return ApiResponse::successResponseWithData($productResource, "All my Products retrieved", Response::HTTP_ACCEPTED);
    }

    //review a product after purchase
    public function reviewProduct(Product $product, CreateProductReviewRequest $request)
    {
        $data = $request->validated();
        $user = User::find(auth()->user()->id);
        $data['product_id'] = $product->id;
        $data['user_id'] = $user['id'];
        $data['reviewer'] = $user['fullname'];

        ProductReview::create($data);
        $productResource = new ProductResource($product);
        return ApiResponse::successResponseWithData($productResource, "Review was sent Successfullly", Response::HTTP_CREATED);
    }

    //get all reviews for a product
    public function getProductReviews(Product $product)
    {
        $reviews = ProductReview::where('product_id', $product->id)->orderBy('created_at', 'DESC')->get();
        $noOfRatings = $reviews->count();
        $average = $reviews->avg('rating');

        $stats = [
            'numberOfRatings' => $noOfRatings,
            'average' => $average,
            'noOfFive' => self::count_reviews($product, 5),
            'noOfFour' => self::count_reviews($product, 4),
            'noOfThree' => self::count_reviews($product, 3),
            'noOfTwo' => self::count_reviews($product, 2),
            'noOfOne' => self::count_reviews($product, 1),
        ];
        $reviewResource = ProductReviewResource::collection($reviews);
        return ApiResponse::successResponseWithMetadata($reviewResource, $stats, "Product review and statistics Retrieved", Response::HTTP_OK);
    }

    protected function count_reviews($product, $value)
    {
        return ProductReview::where('product_id', $product->id)->where('rating', $value)->count();
    }
}
