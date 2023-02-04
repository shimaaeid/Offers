<?php

use App\Http\Controllers\BestOffersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopWatchesController;
use App\Http\Controllers\UserLikesController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\InfoSettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// require __DIR__ . '/auth.php';

// Route::group(['middleware' => 'guest'], function () {
//     Route::redirect('/', 'login');
// });

// Route::get('/dashboard', function () {
//     return redirect(app()->getLocale());
// });

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        // 'prefix' => 'admin', 'namespace' => 'Admin,

        'middleware' => [
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            'auth:admin',

        ],
    ],
    function () {

        Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

        Route::resource('countries', CountryController::class);
        // Route::put('countries/update', [CountryController::class, 'update'])->name('countries.update');
        Route::post('updateFlag', [
            CountryController::class,
            'updateFlag',
        ])->name('updateFlag');
        Route::resource('cities', CityController::class);
        Route::resource('categories', CategoryController::class);
        Route::post('updateImage', [
            CategoryController::class,
            'updateImage',
        ])->name('updateImage');
        Route::resource('shops', ShopController::class);
        Route::post('updateProfileImage', [
            ShopController::class,
            'updateProfileImage',
        ])->name('updateProfileImage');
        Route::post('updateCoverImage', [
            ShopController::class,
            'updateCoverImage',
        ])->name('updateCoverImage');
        Route::post('updateCities', [
            ShopController::class,
            'updateCities',
        ])->name('updateCities');
        Route::get('/country/{id}', [CountryController::class, 'getCities']);
        Route::post('update-status', [ShopController::class, 'updateStatus'])->name('updateStatus');
        Route::resource('offers', OffersController::class);
        Route::post('updateOfferImage', [
            OffersController::class,
            'updateOfferImage',
        ])->name('updateOfferImage');
        Route::resource('best-offers', BestOffersController::class);
        Route::post('updateImageBestOffer', [
            BestOffersController::class,
            'updateImageBestOffer',
        ])->name('updateImageBestOffer');
        Route::resource('shop-watches', ShopWatchesController::class);
        Route::resource('offer-likes', UserLikesController::class);
        Route::resource('settings', InfoSettingController::class);
    }
);
