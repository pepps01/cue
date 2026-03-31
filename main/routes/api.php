<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\AgoraController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\Flip\JobController;
use App\Http\Controllers\Flip\MerchantController;
use App\Http\Controllers\Flip\ProductController;
use App\Http\Controllers\Flip\ServiceController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\MessagingController;
use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("cue", function(){return "Cue is rected";});

Route::group(['middleware' => ['json.response']], function () {

    // Unauthenticated Routes
    Route::group(['prefix' => 'auth', 'middleware' => ['json.response']], function () {
        Route::post('login/{application_name}', [AuthController::class, 'login'])->where('application_name', 'flip|cue|cueDriver|cueChowVendor|admin');
        Route::post('register', [AuthController::class, 'register']);
        Route::post('verify-email/{application_name}', [VerificationController::class, 'verifyEmail'])->where('application_name', 'flip|cue|cueDriver|admin');
        Route::post('resend-verify-code/{application_name}', [VerificationController::class, 'resendVerifyCode'])->where('application_name', 'flip|cue|cueDriver|admin');
        Route::post('request-reset-password/{application_name}', [PasswordController::class, 'sendResetPasswordCode'])->where('application_name', 'flip|cue|cueDriver|admin');
        Route::post('reset-password/{application_name}', [PasswordController::class, 'resetPassword'])->where('application_name', 'flip|cue|cueDriver|admin');
        Route::post('verify-otp', [VerificationController::class, 'verifyPasswordOtp']);
        Route::get('redirect/{provider}', [AuthController::class, 'redirectSocial'])->where('provider', 'google|facebook');
        Route::get('callback/{provider}', [AuthController::class, 'callbackSocial'])->where('provider', 'google|facebook');
    });

    Route::get('account/user-profile/{user}', [UserController::class, 'getUserProfile']);
    Route::get('flip/product/categories', [ProductController::class, 'allCategories']);
    Route::get('flip/product/all-products', [ProductController::class, 'allProducts']);
    Route::get('flip/product/products-by-category/{category}', [ProductController::class, 'productsByCategory']);
    Route::get('flip/product/single-product/{product}', [ProductController::class, 'singleProduct']);
    Route::get('flip/product/get-product-reviews-stats/{product}', [ProductController::class, 'getProductReviews']);
    Route::get('flip/product/product-by-merchant/{merchant}', [ProductController::class, 'productByMerchant']);
    Route::get('flip/product/all-brands', [ProductController::class, 'getAllBrands']);
    Route::get('flip/product/single-brand/{brand}', [ProductController::class, 'getSingleBrand']);
    Route::get('flip/product/products-by-brand/{brand}', [ProductController::class, 'getProductByBrand']);
    Route::get('flip/product/brands-by-category/{category}', [ProductController::class, 'getBrandsByCategory']);
    Route::get('flip/merchant/single-merchant/{merchant}', [MerchantController::class, 'singleMerchant']);
    Route::get('flip/merchant/business-merchants', [MerchantController::class, 'allBusinessMerchants']);
    Route::get('flip/merchant/personal-merchants', [MerchantController::class, 'allPersonalMerchants']);
    Route::get('flip/merchant/merchant-categories', [MerchantController::class, 'getMerchantCategories']);
    Route::get('flip/merchant/merchant-by-category/{category}', [MerchantController::class, 'getMerchantByCategories']);
    Route::get('flip/job/all-job-posts', [JobController::class, 'allJobs']);
    Route::get('flip/job/job-posts-by-userID/{user}', [JobController::class, 'jobsByUserID']);
    Route::get('flip/job/single-job-posts/{job}', [JobController::class, 'singleJob']);
    Route::get('flip/service/categories', [ServiceController::class, 'allCategories']);
    Route::get('flip/service/all-services', [ServiceController::class, 'allServices']);
    Route::get('flip/service/single-service/{service}', [ServiceController::class, 'singleService']);
    Route::get('flip/service/get-service-reviews-stats/{service}', [ServiceController::class, 'getServiceReviews']);
    Route::get('flip/service/service-by-merchant/{merchant}', [ServiceController::class, 'serviceByMerchant']);
    Route::get('flip/service/service-by-category/{category}', [ServiceController::class, 'serviceByCategory']);
    Route::get('countries', [GeneralController::class, 'getAllCountries']);
    Route::get('single-country/{country}', [GeneralController::class, 'singleCountry']);
    Route::get('states/{country}', [GeneralController::class, 'getStates']);
    Route::get('single-state/{state}', [GeneralController::class, 'singleState']);
    Route::get('lgas/{state}', [GeneralController::class, 'getAllLgas']);
    Route::get('single-lga/{lga}', [GeneralController::class, 'getSingleLga']);
    Route::get('banks', [GeneralController::class, 'getBanks']);
    Route::get('single-bank/{bank}', [GeneralController::class, 'getSingleBank']);


    //Authenticated routes
    Route::group(['prefix' => 'account', 'middleware' => ['auth:api', 'json.response', 'active']], function () {
        //Profile Management
        Route::get('my-profile', [UserController::class, 'getProfile']);
        Route::post('change-password', [UserController::class, 'changePassword']);
        Route::post('update-profile-picture', [UserController::class, 'updateProfilePicture']);
        Route::post('update-bank-info', [UserController::class, 'updateBankInfo']);

        //Card Management
        Route::get('card/all', [UserController::class, 'allCards']);
        Route::post('card/store', [UserController::class, 'storeCard']);
        Route::get('card/show/{card}', [UserController::class, 'singleCard']);
        Route::delete('card/remove/{card}', [UserController::class, 'removeCard']);

        Route::get('notifications', [UserController::class, 'getNotifications']);
        Route::post('toggle-notification/{status}', [UserController::class, 'toggleNotification']);
        Route::delete('delete', [UserController::class, 'deleteAccount']);

        // Wallet Management
        Route::get('get-wallet-balance', [WalletController::class, 'getWalletBalance']);
        Route::post('top-up-wallet', [WalletController::class, 'topUpWallet']);

        //Transactions
        Route::get('my-transactions', [WalletController::class, 'myTransactions']);
        Route::get('single-transaction/{transaction}', [WalletController::class, 'singleTransaction']);
        Route::delete('delete-transaction/{transaction}', [WalletController::class, 'deleteTransaction']);

        // Withdrawal
        Route::post('request-withdrawal', [WalletController::class, 'requestWithdrawal']);
        Route::get('withdrawal-requests', [WalletController::class, 'withdrawalRequests']);
        Route::get('single-withdrawal-request/{withdraw}', [WalletController::class, 'singleWithdrawalRequest']);
        Route::delete('delete-withdrawal-request/{withdraw}', [WalletController::class, 'deleteWithdrawalRequest']);

        //Messaging
        Route::post('send-message/{user}', [MessagingController::class, 'sendMessage']);
        Route::post('reply-message/{chatID}', [MessagingController::class, 'replyMessage']);
        Route::get('all-chats', [MessagingController::class, 'getChats']);
        Route::get('chat-with-user/{user}', [MessagingController::class, 'chatWithUser']);

        //Agoracontroller
        Route::post('generate-voice-token', [AgoraController::class, 'generateCallToken']);

        //Community Chat Routes
        Route::group(['prefix' => 'community'], function () {
            Route::post('create', [CommunityController::class, 'createPost']);
            Route::get('all-posts', [CommunityController::class, 'allPosts']);
            Route::get('single-post/{post}', [CommunityController::class, 'singlePost']);
            Route::delete('delete-post/{post}', [CommunityController::class, 'deletePost']);
            Route::get('posts-by-me', [CommunityController::class, 'postsByMe']);
            Route::post('like-post/{post}', [CommunityController::class, 'likePost']);
            Route::post('unlike-post/{post}', [CommunityController::class, 'unLikePost']);
            Route::post('dislike-post/{post}', [CommunityController::class, 'disLikePost']);
            Route::get('reaction-to-post/{post}', [CommunityController::class, 'reactionToPost']);
            Route::post('comment/{post}', [CommunityController::class, 'comment']);
            Route::delete('remove-comment/{comment}', [CommunityController::class, 'removeComment']);
        });
    });

    //Flip Routes
    include('flip.php');

    //Cue and CueDriver Routes
    include('cue.php');

    //General Admin Routes
    include('admin.php');
});
