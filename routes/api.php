<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\InfoSettingsController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\ShopController;

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
// test the new branch
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

});

Route::group(['middleware' => ['changeLanguage']], function() {

    Route::get('countries', [CountryController::class, 'index']);
    Route::get('cities/{id}', [CityController::class, 'cities'] );
    Route::get('categories-city/{id?}', [CityController::class, 'categoriesCity']);
    Route::get('top-liked/{id?}',[OfferController::class, 'topLikedOffers']);
    Route::get('online-stores/{id?}', [ShopController::class, 'onlineStores']);
    Route::get('online-offers/{id}', [OfferController::class, 'onlineOffers']);
    Route::get('store-details/{id}', [ShopController::class, 'storeDetails']);
    Route::get('offer-details/{id}', [OfferController::class, 'offerDetails']);
    Route::get('category-stores', [ShopController::class,'categoryStores']);
    Route::get('category-offers', [OfferController::class, 'categoryOffers']);

    Route::post('like', [OfferController::class, 'likeOffer']);
    Route::post('unlike', [OfferController::class, 'unLikeOffer']);
    Route::get('wishlist', [OfferController::class, 'wishlist']);
    Route::get('info-settings', [InfoSettingsController::class, 'index']);
});

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
    Route::post('/add-offer', [OfferController::class, 'addOffer']);
    Route::post('/delete-offer', [OfferController::class, 'deleteOffer']);

});
