<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminActivityLogsController;
use App\Http\Controllers\Admin\AdminCartController;
use App\Http\Controllers\Admin\AdminProductCategoryController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminProposalController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use App\Http\Controllers\Admin\AdminServiceCategoryController;
use App\Http\Controllers\Admin\AdminSOSController;
use App\Http\Controllers\Admin\AdminTripController;

Route::group(['prefix' => 'admin', 'middleware' => ['auth:api', 'admin']], function () {

    //User Management
    Route::prefix('user')->group(function () {
        Route::get('all-users', [AdminUserController::class, 'getAllUsers']);
        Route::get('users-by-role/{role}', [AdminUserController::class, 'getUsersByRole'])->where('role', 'consumer|merchant|driver|rider|admin|superadmin');
        Route::get('single-user/{user}', [AdminUserController::class, 'getSingleUser']);
        Route::post('create-user', [AdminUserController::class, 'createUser']);
        Route::get('verify-email/{user}', [AdminUserController::class, 'verifyEmail']);
        Route::get('unverify-email/{user}', [AdminUserController::class, 'unVerifyEmail']);
        Route::get('activate-user/{user}', [AdminUserController::class, 'activateUser']);
        Route::get('deactivate-user/{user}', [AdminUserController::class, 'deactivateUser']);
        Route::delete('delete-user/{user}', [AdminUserController::class, 'deleteUser']);
    });

    //Product Management
    Route::prefix('product')->group(function () {
        Route::get('all-products', [AdminProductController::class, 'getAllProducts']);
        Route::get('products-by-category/{category}', [AdminProductController::class, 'productsByCategory']);
        Route::get('products-by-merchant/{merchant}', [AdminProductController::class, 'productsByMerchant']);
        Route::post('create-product/{merchant}', [AdminProductController::class, 'createProduct']);
        Route::post('update-product/{product}', [AdminProductController::class, 'updateProduct']);
        Route::get('single-product/{product}', [AdminProductController::class, 'singleProduct']);
        Route::post('add-product-feature/{product}', [AdminProductController::class, 'addProductFeature']);
        Route::post('edit-product-feature/{feature}', [AdminProductController::class, 'editProductFeature']);
        Route::delete('remove-product-feature/{feature}', [AdminProductController::class, 'removeProductFeature']);
        Route::post('add-product-specs/{product}', [AdminProductController::class, 'addProductSpecs']);
        Route::post('edit-product-spec/{spec}', [AdminProductController::class, 'editProductSpec']);
        Route::delete('remove-product-spec/{spec}', [AdminProductController::class, 'removeProductSpec']);
        Route::post('add-product-images/{product}', [AdminProductController::class, 'addProductImages']);
        Route::post('edit-product-image/{image}', [AdminProductController::class, 'editProductImage']);
        Route::delete('remove-product-image/{image}', [AdminProductController::class, 'removeProductImage']);
        Route::post('set-primary-image/{product}/{image}', [AdminProductController::class, 'setPrimaryImage']);
        Route::get('deactivate-product/{product}', [AdminProductController::class, 'deactivateProduct']);
        Route::get('activate-product/{product}', [AdminProductController::class, 'activateProduct']);
        Route::delete('delete-product/{product}', [AdminProductController::class, 'deletedProduct']);
    });

    //Product Category Management
    Route::prefix('productcategory')->group(function () {
        Route::get('all-product-categories', [AdminProductCategoryController::class, 'getAllProductCategories']);
        Route::get('single-product-category/{category}', [AdminProductCategoryController::class, 'getSingleProductCategories']);
        Route::post('create-product-category', [AdminProductCategoryController::class, 'createProductCategory']);
        Route::post('update-product-category/{category}', [AdminProductCategoryController::class, 'updateProductCategory']);
        Route::post('deactivate-category/{category}', [AdminProductCategoryController::class, 'deactivateCategory']);
        Route::post('activate-category/{category}', [AdminProductCategoryController::class, 'activateCategory']);
        Route::delete('delete-category/{category}', [AdminProductCategoryController::class, 'deleteCategory']);
    });

    //Services Management
    Route::prefix('service')->group(function () {
        Route::get('all-services', [AdminServiceController::class, 'getAllServices']);
        Route::get('single-service/{service}', [AdminServiceController::class, 'getSingleServices']);
        Route::get('services-by-merchant/{merchant}', [AdminServiceController::class, 'servicesByMerchant']);
        Route::post('create-service/{merchant}', [AdminServiceController::class, 'createService']);
        Route::post('update-service/{service}', [AdminServiceController::class, 'updateService']);
        Route::post('add-service-images/{service}', [AdminServiceController::class, 'addServiceImages']);
        Route::post('edit-service-image/{image}', [AdminServiceController::class, 'editServiceImage']);
        Route::delete('remove-service-image/{image}', [AdminServiceController::class, 'removeServiceImage']);
        Route::post('set-primary-image/{service}/{image}', [AdminServiceController::class, 'setPrimaryImage']);
        Route::get('deactivate-service/{service}', [AdminServiceController::class, 'deactivateService']);
        Route::get('activate-service/{service}', [AdminServiceController::class, 'activateService']);
        Route::delete('delete-service/{service}', [AdminServiceController::class, 'deleteService']);
    });

    //Service Category Management
    Route::prefix('servicecategory')->group(function () {
        Route::get('all-service-categories', [AdminServiceCategoryController::class, 'getAllServiceCategories']);
        Route::get('single-service-category/{category}', [AdminServiceCategoryController::class, 'getSingleServiceCategory']);
        Route::post('create-service-category', [AdminServiceCategoryController::class, 'createServiceCategory']);
        Route::post('update-service-category/{category}', [AdminServiceCategoryController::class, 'updateServiceCategory']);
        Route::post('deactivate-category/{category}', [AdminServiceCategoryController::class, 'deactivateCategory']);
        Route::post('activate-category/{category}', [AdminServiceCategoryController::class, 'activateCategory']);
        Route::delete('delete-category/{category}', [AdminServiceCategoryController::class, 'deleteCategory']);
    });

    //Job Management
    Route::prefix('job')->group(function () {
        Route::get('all-jobs', [AdminJobController::class, 'getAllJobs']);
        Route::get('jobs-by-user/{user}', [AdminJobController::class, 'getJobsByUser']);
        Route::get('single-job/{job}', [AdminJobController::class, 'getSingleJob']);
        Route::post('create-job/{user}', [AdminJobController::class, 'createJob']);
        Route::post('update-job/{job}', [AdminJobController::class, 'updateJob']);
        Route::post('deactivate-job-post/{job}', [AdminJobController::class, 'deactivateJobPost']);
        Route::post('activate-job-post/{job}', [AdminJobController::class, 'activateJobPost']);
        Route::delete('delete-job-post/{job}', [AdminJobController::class, 'deleteJobPost']);
    });

    //Cart Management
    Route::prefix('cart')->group(function () {
        Route::get('all-carts', [AdminCartController::class, 'getAllCarts']);
    });

    //Order Management
    Route::prefix('order')->group(function () {
        Route::get('all-orders', [AdminOrderController::class, 'getAllOrders']);
        Route::get('single-order/{order}', [AdminOrderController::class, 'getSingleOrder']);
        Route::get('orders-by-user/{user}', [AdminOrderController::class, 'getOrdersByUser']);
        Route::get('orders-for-merchant/{merchant}', [AdminOrderController::class, 'getOrdersForMerchant']);
        Route::post('create-order/{user}', [AdminOrderController::class, 'createOrder']);
        Route::post('accept-order/{order}', [AdminOrderController::class, 'acceptOrder']);
        Route::post('reject-order/{order}', [AdminOrderController::class, 'rejectOrder']);
        Route::delete('delete-order/{order}', [AdminOrderController::class, 'deleteOrder']);
    });

    //Proposal Management
    Route::prefix('proposal')->group(function () {
        Route::get('all-proposals', [AdminProposalController::class, 'getAllProposals']);
        Route::get('single-proposal/{proposal}', [AdminProposalController::class, 'getSingleProposal']);
        Route::get('proposals-by-merchant/{merchant}', [AdminProposalController::class, 'getProposalsByMerchant']);
        Route::get('proposals-for-job/{job}', [AdminProposalController::class, 'getProposalsForJob']);
    });

    //Withdrawal Management
    Route::prefix('withdrawal')->group(function () {
        Route::get('all-withdrawals', [AdminWithdrawalController::class, 'getAllWithdrawals']);
        Route::get('withdrawals-by-user/{user}', [AdminWithdrawalController::class, 'getWithdrawalsByUser']);
        Route::get('withdrawals-by-application/{application_name}', [AdminWithdrawalController::class, 'getByApplication'])->where('application_name', 'flip|cue|cueDriver');
        Route::get('single-withdrawal/{withdrawal}', [AdminWithdrawalController::class, 'getSingleWithdrawal']);
        Route::post('create-withdrawal-request/{user}', [AdminWithdrawalController::class, 'createWithdrawal']);
        Route::post('accept-withdrawal/{withdrawal}', [AdminWithdrawalController::class, 'acceptWithdrawal']);
        Route::post('reject-withdrawal/{withdrawal}', [AdminWithdrawalController::class, 'rejectWithdrawal']);
        Route::post('disburse-funds/{withdrawal}', [AdminWithdrawalController::class, 'disburseFunds']);
        Route::delete('delete-withdrawal/{withdrawal}', [AdminWithdrawalController::class, 'deleteWithdrawal']);
    });

    //Transaction Management
    Route::prefix('transaction')->group(function () {
        Route::get('all-transactions', [AdminTransactionController::class, 'getAllTransactions']);
        Route::get('single-transaction/{transaction}', [AdminTransactionController::class, 'singleTransaction']);
        Route::get('transactions-by-user/{user}', [AdminTransactionController::class, 'getTransactionsByUser']);
        Route::get('transactions-by-application/{application_name}', [AdminTransactionController::class, 'getByApplication'])->where('application_name', 'flip|cue|cueDriver');
        Route::get('transactions-by-payment-method/{payment_method}', [AdminTransactionController::class, 'getByPaymentMethod'])->where('payment_method', 'wallet|paystack');
        Route::delete('delete-transaction/{transaction}', [AdminTransactionController::class, 'deleteTransaction']);
    });

    //Admin Activity logs controllers
    Route::prefix('logs')->group(function () {
        Route::get('all-logs', [AdminActivityLogsController::class, 'getAllLogs']);
        Route::get('single-log/{log}', [AdminActivityLogsController::class, 'getSingleLog']);
        Route::get('logs-by-admin/{admin}', [AdminActivityLogsController::class, 'getLogsByAdmin']);
    });

    //Admin Trip Management
    Route::prefix('trips')->group(function () {
        Route::get('all-trips', [AdminTripController::class, 'getAllTrips']);
        Route::get('single-trip/{trip}', [AdminTripController::class, 'singleTrip']);
        Route::get('trips-by-rider/{user}', [AdminTripController::class, 'tripByRider']);
        Route::get('trips-by-driver/{user}', [AdminTripController::class, 'tripByDriver']);
        Route::delete('delete-trip/{trip}', [AdminTripController::class, 'deleteTrip']);
    });

    //Admin SOS Management
    Route::prefix('sos')->group(function () {
        Route::get('all-sos', [AdminSOSController::class, 'getAllSOS']);
        Route::get('single-sos/{sos}', [AdminSOSController::class, 'getSingleSOS']);
        Route::get('all-sos-reports', [AdminSOSController::class, 'getAllSOSReports']);
        Route::get('single-sos-report/{report}', [AdminSOSController::class, 'getSinlgeSOSReport']);
        Route::get('reports-by-sos/{sosID}', [AdminSOSController::class, 'getReportsBySOSID']);
        Route::delete('remove-sos/{sos}', [AdminSOSController::class, 'removeSOS']);
        Route::delete('remove-report/{report}', [AdminSOSController::class, 'removeReport']);
    });
});
