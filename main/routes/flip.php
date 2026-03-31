<?php

use App\Http\Controllers\Flip\CartController;
use App\Http\Controllers\Flip\ConsumerController;
use App\Http\Controllers\Flip\JobController;
use App\Http\Controllers\Flip\MerchantController;
use App\Http\Controllers\Flip\OrderController;
use App\Http\Controllers\Flip\ProductController;
use App\Http\Controllers\Flip\ProposalController;
use App\Http\Controllers\Flip\RequestServiceController;
use App\Http\Controllers\Flip\ServiceController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'flip', 'middleware' => ['auth:api', 'json.response', 'active']], function () {
    // Both Consumer and Merchants
    Route::group(['middleware' => ['consumer_or_merchant']], function () {

        //Cart Managment
        Route::get('cart/get-cart', [CartController::class, 'getCart']);
        Route::post('cart/create-cart/{product}', [CartController::class, 'createCart']);
        Route::post('cart/update-cart/{cart}/{action}', [CartController::class, 'updateCart'])->where('action', 'add|remove');
        Route::delete('cart/remove-cart-item/{cart}', [CartController::class, 'removeCart']);

        // Order Management
        Route::post('order/place-order', [OrderController::class, 'placeOrder']);
        Route::get('order/single-order/{order}', [OrderController::class, 'getSingleOrder']);
        Route::get('order/orders-by-me', [OrderController::class, 'ordersByMe']);
        Route::post('product/review-product/{product}', [ProductController::class, 'reviewProduct']);

        // Services Request Management
        Route::post('service/service-request/{service}', [RequestServiceController::class, 'serviceRequest']);
        Route::post('service/pay-for-service/{serviceRequest}', [RequestServiceController::class, 'payForService']);
        Route::post('service/mark-as-completed/{serviceRequest}', [RequestServiceController::class, 'markAsCompleted']);
        Route::get('service/my-service-requests', [RequestServiceController::class, 'getClientServiceRequests']);
        Route::get('service/single-service-request/{serviceRequest}', [RequestServiceController::class, 'singleServiceRequest']);
        Route::post('service/review-service/{serviceRequest}', [RequestServiceController::class, 'reviewService']);

        // Job Management
        Route::post('job/create-job', [JobController::class, 'createJob']);
        Route::post('job/update-job/{job}', [JobController::class, 'updateJob']);
        Route::get('job/job-posts-by-me', [JobController::class, 'jobsByMe']);
        Route::post('job/deactivate-job-post/{job}', [JobController::class, 'deactivateJobPost']);
        Route::post('job/activate-job-post/{job}', [JobController::class, 'activateJobPost']);

        //Proposal Management
        Route::get('proposal/all-received-proposals', [ProposalController::class, 'receivedProposals']);
        Route::get('proposal/single-proposal/{proposal}', [ProposalController::class, 'singleProposal']);
        Route::get('proposal/proposals-by-job/{job}', [ProposalController::class, 'proposalsByJob']);
        Route::post('proposal/accept-proposal/{proposal}', [ProposalController::class, 'acceptProposal']);
        Route::post('proposal/review-proposal/{proposal}', [ProposalController::class, 'reviewProposal']);
        Route::post('proposal/reject-proposal/{proposal}', [ProposalController::class, 'rejectProposal']);
        Route::post('proposal/pay-for-project/{proposal}', [ProposalController::class, 'payForProject']);
    });

    // Consumer Management
    Route::group(['prefix' => 'consumer', 'middleware' => ['consumer']], function () {
        Route::post('update-consumer', [ConsumerController::class, 'updateConsumer']);
    });

    // Merchant Management
    Route::group(['prefix' => 'merchant', 'middleware' => ['merchant']], function () {
        //Business merchants only
        Route::group(['middleware' => ['business_merchants']], function () {
            // Business Merchant Profile Management
            Route::post('/update-merchant-business', [MerchantController::class, 'updateMerchantBusiness']);

            //Merchant Product Management
            Route::get('/product/products-by-logged-merchant', [ProductController::class, 'productByLoggedMerchant']);
            Route::post('/product/create-product', [ProductController::class, 'createProduct']);
            Route::post('/product/update-product/{product}', [ProductController::class, 'updateProduct']);
            Route::post('/product/add-product-feature/{product}', [ProductController::class, 'addProductFeature']);
            Route::post('/product/edit-product-feature/{feature}', [ProductController::class, 'editProductFeature']);
            Route::delete('/product/remove-product-feature/{feature}', [ProductController::class, 'removeProductFeature']);
            Route::post('/product/add-product-specs/{product}', [ProductController::class, 'addProductSpecs']);
            Route::post('/product/edit-product-spec/{spec}', [ProductController::class, 'editProductSpec']);
            Route::delete('/product/remove-product-spec/{spec}', [ProductController::class, 'removeProductSpec']);
            Route::post('/product/add-product-images/{product}', [ProductController::class, 'addProductImages']);
            Route::post('/product/edit-product-image/{image}', [ProductController::class, 'editProductImage']);
            Route::delete('/product/remove-product-image/{image}', [ProductController::class, 'removeProductImage']);
            Route::post('/product/set-primary-image/{product}/{image}', [ProductController::class, 'setPrimaryImage']);
            Route::get('/product/deactivate-product/{product}', [ProductController::class, 'deactivateProduct']);
            Route::get('/product/activate-product/{product}', [ProductController::class, 'activateProduct']);
            Route::get('/product/my-products', [ProductController::class, 'myProducts']);

            //Merchant Service Management
            Route::get('/service/services-by-logged-merchant', [ServiceController::class, 'serviceByLoggedMerchant']);
            Route::post('/service/create-service', [ServiceController::class, 'createService']);
            Route::post('/service/update-service/{service}', [ServiceController::class, 'updateService']);
            Route::post('/service/add-service-images/{service}', [ServiceController::class, 'addServiceImages']);
            Route::post('/service/edit-service-image/{image}', [ServiceController::class, 'editServiceImage']);
            Route::delete('/service/remove-service-image/{image}', [ServiceController::class, 'removeServiceImage']);
            Route::post('/service/set-primary-image/{service}/{image}', [ServiceController::class, 'setPrimaryImage']);
            Route::get('/service/deactivate-service/{service}', [ServiceController::class, 'deactivateService']);
            Route::get('/service/activate-service/{service}', [ServiceController::class, 'activateService']);
            Route::get('/service/my-services', [ServiceController::class, 'myServices']);
            Route::get('/service/all-service-requests', [RequestServiceController::class, 'merchantServiceRequests']);
            Route::get('service/single-service-request/{serviceRequest}', [RequestServiceController::class, 'singleServiceRequest']);
            Route::post('/service/accept-request/{service}', [RequestServiceController::class, 'acceptRequest']);
            Route::post('/service/reject-request/{service}', [RequestServiceController::class, 'rejectRequest']);

            // Business Merchant Order Management
            Route::get('order/orders-for-merchants', [OrderController::class, 'ordersForMerchants']);
            Route::post('order/accept-order/{order}', [OrderController::class, 'acceptOrder']);
            Route::post('order/reject-order/{order}', [OrderController::class, 'rejectOrder']);
        });

        //Personal merchants only
        Route::group(['middlware' => ['personal_merchants']], function () {
            // Personal Merchant Profession management
            Route::post('/update-merchant-personal', [MerchantController::class, 'updateMerchantPersonal']);
            Route::post('/add-merchant-skills', [MerchantController::class, 'addMerchantSkills']);
            Route::post('/edit-merchant-skill/{skill}', [MerchantController::class, 'editMerchantSkill']);
            Route::delete('/remove-merchant-skill/{skill}', [MerchantController::class, 'removeMerchantSkill']);
            Route::post('/add-merchant-languages', [MerchantController::class, 'addMerchantLanguages']);
            Route::post('/edit-merchant-language/{language}', [MerchantController::class, 'editMerchantLanguage']);
            Route::delete('/remove-merchant-language/{language}', [MerchantController::class, 'removeMerchantLanguage']);
            Route::post('/add-merchant-work', [MerchantController::class, 'addMerchantWorkHistory']);
            Route::post('/edit-merchant-work/{work}', [MerchantController::class, 'editMerchantWork']);
            Route::delete('/remove-merchant-work/{work}', [MerchantController::class, 'removeMerchantWork']);
            Route::post('/add-merchant-education', [MerchantController::class, 'addMerchantEducationHistory']);
            Route::post('/edit-merchant-education/{education}', [MerchantController::class, 'editMerchantEducation']);
            Route::delete('/remove-merchant-education/{education}', [MerchantController::class, 'removeMerchantEducation']);
            Route::post('/add-merchant-project', [MerchantController::class, 'addMerchantProject']);
            Route::post('/edit-merchant-project/{project}', [MerchantController::class, 'editMerchantProject']);
            Route::delete('/remove-merchant-project/{project}', [MerchantController::class, 'removeMerchantProject']);

            // Proposal Management
            Route::post('proposal/create-proposal/{job}', [ProposalController::class, 'createProposal']);
            Route::get('proposal/my-proposals', [ProposalController::class, 'myProposals']);
            Route::get('proposal/my-proposals-by-job/{job}', [ProposalController::class, 'myProposalsByJob']);
            Route::get('proposal/single-proposal/{proposal}', [ProposalController::class, 'singleProposal']);
            Route::post('proposal/update-proposal/{proposal}', [ProposalController::class, 'updateProposal']);
            Route::delete('proposal/withdraw-proposal/{proposal}', [ProposalController::class, 'withdrawProposal']);
        });
    });
});
