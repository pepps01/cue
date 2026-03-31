<?php

use App\Http\Controllers\Cue\CueTripController;
use App\Http\Controllers\Cue\RiderController;
use App\Http\Controllers\CueDriver\DriverController;
use App\Http\Controllers\CueDriver\TripController;
use App\Http\Controllers\CueVendor\MealController;
use App\Http\Controllers\CueVendor\VendorController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\GeneralSOSController;
use Illuminate\Support\Facades\Route;


// order changes
Route::get('/runner', function(){
    return 1;
});

Route::get('/test-account', function(){
    return 1;
});



Route::get('cars', [GeneralController::class, 'getCars']);
Route::get('manufacturers', [GeneralController::class, 'getManufacturers']);
Route::get('models', [GeneralController::class, 'getModels']);
Route::get('trip-pricing', [GeneralController::class, 'getTripPricing']);
Route::get('trip-location-pricing/{status}', [GeneralController::class, 'getTripLocationPricing'])->where('status', 'essential|luxury|economy');
Route::get('trip-location-pricing-by-id/{status}/{id}', [GeneralController::class, 'getTripLocationPricingByID'])->where('status', 'essential|luxury|economy');
Route::get('trip-location-pricing-by-state/{status}/{state}', [GeneralController::class, 'getTripLocationPricingByState'])->where('status', 'essential|luxury|economy');
Route::get('driver/driver-reviews/{driver}', [DriverController::class, 'getDriverReviews']);
Route::get('rider/rider-reviews/{rider}', [RiderController::class, 'getRiderReviews']);
Route::get('meal/index', [MealController::class, 'index']);
Route::get('restaurants', [MealController::class, 'getRestaurants']);
Route::get('meal/show/{meal}', [MealController::class, 'show']);

Route::group(['middleware' => ['auth:api', 'json.response', 'active', 'driver_or_rider']], function () {
    Route::post('update-trip-driver/{trip}', [CueTripController::class, 'updateDriverForTrip']);

    //INTIATE SOS EMERGENCY
    Route::post('sos/create/{trip}', [GeneralSOSController::class, 'initiate']);
    Route::post('sos/resolve/{sos}', [GeneralSOSController::class, 'resolve']);

    //REACT TO SOS EMERGENCY
    Route::post('sos/accept/{sos}', [GeneralSOSController::class, 'acceptSOS']);
    Route::post('sos/report/{sos}', [GeneralSOSController::class, 'reportSOS']);
    Route::get('sos/show/{sos}', [GeneralSOSController::class, 'sosDetails']);
});

//Cue Driver Routes
Route::group(['prefix' => 'cueDriver', 'middleware' => ['auth:api', 'json.response', 'active', 'driver']], function () {

    //Driver profile management
    Route::post('update-driver', [DriverController::class, 'updateDriver']);
    Route::post('verify-driver', [DriverController::class, 'verifyDriver']);

    //Driver earing routes
    Route::get('trip-earnings', [DriverController::class, 'tripEarnings']);
    Route::get('single-earning/{earning}', [DriverController::class, 'singleEarning']);

    //Driver online presence management
    Route::post('go-online', [DriverController::class, 'goOnline']);
    Route::post('go-offline', [DriverController::class, 'goOffline']);

    //Vehicle Management
    Route::post('add-vehicle', [DriverController::class, 'addVehicle']);
    Route::post('edit-vehicle/{vehicle}', [DriverController::class, 'editVehicle']);
    Route::delete('delete-vehicle/{vehicle}', [DriverController::class, 'deleteVehicle']);
    Route::post('update-status/{vehicle}/{status}', [DriverController::class, 'updateStatus'])->where('status', 'economy|business|luxury');

    //Trip Management
    Route::get('my-trips', [TripController::class, 'myTrips']);
    Route::get('single-trip/{trip}', [TripController::class, 'singleTrip']);
    Route::post('accept-trip/{trip}', [TripController::class, 'acceptTrip']);
    Route::post('reject-trip/{trip}', [TripController::class, 'rejectTrip']);
    Route::post('cancel-trip/{trip}', [TripController::class, 'cancelTrip']);
    Route::post('arrived-pickup/{trip}', [TripController::class, 'driverArrivedPickup']);
    Route::post('start-trip/{trip}', [TripController::class, 'startTrip']);
    Route::post('end-trip/{trip}', [TripController::class, 'endTrip']);
    Route::post('confirm-cash-payment/{trip}', [TripController::class, 'confirmCashPayment']);
    Route::post('review-rider/{user}', [TripController::class, 'reviewRider']);
    Route::delete('delete-trip/{trip}', [TripController::class, 'deleteTrip']);
});

//Cue Rider Routes
Route::group(['prefix' => 'cue', 'middleware' => ['auth:api', 'json.response', 'active', 'rider']], function () {

    //Rider profile Management
    Route::post('update-rider', [RiderController::class, 'updateRider']);
    Route::post('favourite-address', [RiderController::class, 'favouriteAddress']);
    Route::delete('remove-favourite-address/{location}', [RiderController::class, 'removeFavouriteAddress']);

    //Trip Management
    Route::post('request-trip/{driver}', [CueTripController::class, 'requestTrip']);
    Route::post('update-destination/{trip}', [CueTripController::class, 'updateDestination']);
    Route::post('cancel-trip/{trip}', [CueTripController::class, 'cancelTrip']);
    Route::get('my-trips', [CueTripController::class, 'myTrips']);
    Route::get('single-trip/{trip}', [CueTripController::class, 'singleTrip']);
    Route::delete('delete-trip/{trip}', [CueTripController::class, 'deleteTrip']);
    Route::post('pay-for-trip/{trip}', [CueTripController::class, 'payForTrip']);
    Route::post('review-driver/{user}', [CueTripController::class, 'reviewDriver']);
});


//Cue Vendor Routes
Route::group(['prefix' => 'cueChowVendor', 'middleware' => ['auth:api', 'json.response', 'active', 'vendor']], function () {

    //Vendor profile management
    Route::post('update-vendor', [VendorController::class, 'updateVendor']);
    Route::post('set-opened-status/{status}', [VendorController::class, 'setStatus'])->where('status', 'true|false');

    //Vendor meals management
    Route::group(['prefix' => 'meal'], function () {
        Route::post('store', [MealController::class, 'store']);
        Route::post('update/{meal}', [MealController::class, 'update']);
        Route::delete('delete/{meal}', [MealController::class, 'delete']);
        Route::get('my-meals', [MealController::class, 'myMeals']);
        Route::post('set-stock-status/{meal}/{status}', [MealController::class, 'setStockStatus']);
    });
});

Route::get('/test-prod', function(){
    return "test-application";
});
