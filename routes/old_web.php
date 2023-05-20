<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
|
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;



Route::get('/', function () {
    $locale = Cookie::get('locale');

    if (isset($locale) && $locale != Null && array_key_exists($locale, config('app.locales'))) {
        App::setLocale($locale);

        return redirect("/" . $locale);
    } else {
        App::setLocale(config('app.fallback_locale'));
        Cookie::queue('locale', App::getLocale());

        return redirect("/" . config('app.fallback_locale'));
    }
});


Route::group(['prefix' => '{locale}', 'middleware' => 'language'], function () {

    Route::get('change/{locale2}', function ($locale, $new) {

        $uri = parse_url(URL::previous())['path'];
        $segments = explode('/', $uri);
        if (isset($segments[3])) {
            unset($segments[0]);
            unset($segments[1]);
            unset($segments[2]);
            $segments[3] = $new;
            return Redirect::to(url(implode("/", $segments)));
        } else {
            return Redirect::to(url('/' . $new));
        }
    });

    Route::get('/', [HomeController::class, 'index']);
    Route::post('/', [HomeController::class, 'postSubscribe']);

    // Auth Routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm']);
    route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);
    route::post('password/reset', [ResetPasswordController::class, 'reset']);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    // My account
    Route::get('/myaccount/{slug?}/{id?}/{id1?}',[RegisterController::class,'account']);

    // profile
    Route::get('profile/password', 'ProfileController@change_password');
    Route::post('profile/password/store', 'ProfileController@store_password');
    Route::get('profile/edit/{id}', 'ProfileController@edit_profile');
    Route::post('profile/edit/{id}', 'ProfileController@save_profile');
    Route::post('upload', 'ProfileController@upload');

    // Products
    Route::get('category/{id}/products', [ProductsController::class, 'index']);
    Route::get('category/{id}', [ProductsController::class, 'categories']);
    Route::get('products/{id}/{slug?}', [ProductsController::class, 'view']);

    Route::get('user/{id}', [UsersController::class, 'profile']);
    Route::get('user/edit/{id}', [UsersController::class, 'edit_profile']);
    Route::put('user/edit/{id}', [UsersController::class, 'save_profile']);
    Route::post('upload', [UsersController::class, 'upload']);

    Route::get('covers', [ProductsController::class, 'covers']);
    Route::get('custom-covers/{id}/{slug}', [ProductsController::class, 'custom_covers']);
    Route::get('covers-type/{id}', [ProductsController::class, 'covers_type']);
//    Route::get('custom-hangers', [ProductsController::class, 'custom_hangers_product']);
    Route::get('custom-hanger-details/{id}', [ProductsController::class, 'custom_hangers_product']);
    Route::get('hangers-type/{id}', [ProductsController::class, 'hangers_type']);

    Route::group(['prefix' => 'products'], function () {
        Route::get('ready-hangers', [ProductsController::class, 'ready_hangers_product']);
        Route::get('ready-hanger-details', [ProductsController::class, 'ready_hanger_details']);
        // Route::get('custom-hangers', [ProductsController::class, 'custom_hangers_product']);
        // Route::get('properties/{status}', [ProductsFrontController::class, 'products']);
        // Route::get('properties/{status}/{category_id}/{id}', [ProductsFrontController::class, 'product_details']);
        // Route::get('products/{category_id}/{slug}', [ProductsFrontController::class, 'index']);
        // Route::get('products/load_ajax_list/{category_id}/{offset?}', [ProductsFrontController::class, 'get_ajax_products']);
        // Route::get('products/{category_id}/{slug}/{id}/{item_slug}', [ProductsFrontController::class, 'view']);
        // Route::get('products/new',[ProductsFrontController::class, 'newarrival']);
        // Route::get('products/{slug}/{model_id}/{model_slug}',[ProductsFrontController::class, 'modelspro']);
    });

    // Cart
    Route::get('cart', [OrdersController::class, 'shoppingCarts']);
    Route::post('add-to-cart/{id}', [OrdersController::class, 'addToCart']);
    Route::get('remove-cart/{id}', [OrdersController::class, 'removeCartItem']);
    Route::post('update-cart/{id}', [OrdersController::class, 'update'])->name('cart.update');
    Route::post('charge', [OrdersController::class, 'charge']);
    Route::get('empty-cart', [OrdersController::class, 'emptyCart']);
    // Wishlist
    Route::get('wishlist', [OrdersController::class, 'wishlist']);
    Route::post('add-to-wishlist/{id}', [OrdersController::class, 'addToWishlist']);
    Route::get('remove-wishlist/{id}', [OrdersController::class, 'removeWishlistItem']);
    Route::get('empty-wishlist', [OrdersController::class, 'emptyWishlist']);
    // Checkout
    Route::get('checkout', [OrdersController::class, 'checkout']);
    Route::post('checkout', [OrdersController::class, 'submitCheckout']);


    Route::get('/home', [HomeController::class, 'index']);
    Route::get('pages/{slug?}', [PagesController::class, 'index']);
    Route::get('contact/{slug?}', [PagesController::class, 'contact']);


});
