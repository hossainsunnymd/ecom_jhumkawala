<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Frontend\DashboardController as CustomerDashboardController;

//login page
Route::get('/login', [LoginController::class, 'loginPage'])->name('login');

//login
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

//register page
Route::get('/register', [RegistrationController::class, 'registerPage'])->name('register');

//register
Route::post('/register', [RegistrationController::class, 'register'])->name('register.post');

//logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/account-address', [PageController::class, 'accountAddress'])->name('account.address');
Route::get('/account-address-add', [PageController::class, 'accountAddressAdd'])->name('account.address.add');
Route::get('/account-details', [PageController::class, 'accountDetails'])->name('account.details');
Route::get('/account-orders', [PageController::class, 'accountOrders'])->name('account.orders');
Route::get('/account-orders-details', [PageController::class, 'accountOrdersDetails'])->name('account.orders.details');
Route::get('/account-review', [PageController::class, 'accountReview'])->name('account.review');
Route::get('/account-wishlist', [PageController::class, 'accountWishList'])->name('account.wishlist');
Route::get('/cart', [PageController::class, 'cart'])->name('cart');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/product/{slug}', [PageController::class, 'productDetails'])->name('product.details');
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::get('/order-confirmation', [PageController::class, 'OrderConfirmation'])->name('order.confirmation');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
Route::get('/shop', [PageController::class, 'shop'])->name('shop');
Route::get('/terms-and-condition', [PageController::class, 'termsAndCondition'])->name('terms.and.condition');
Route::get('/wish-list', [PageController::class, 'wishList'])->name('wish.list');


Route::group(['prefix' => 'customer', 'middleware' => 'auth'], function () {

    //customer review
    Route::post('/review', [ReviewController::class, 'store'])->name('customer.review.store');

    //customer cart
    Route::post('/cart/store', [CartController::class, 'addToCart'])->name('customer.cart.store');
    Route::get('/carts', [CartController::class, 'index'])->name('customer.cart.index');
    Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('customer.cart.remove');

    //customer checkout
    Route::get('/checkout',[CheckoutController::class,'index'])->name('customer.checkout.index');

    //customer order
    Route::get('/orders', [OrderController::class, 'index'])->name('customer.order.list');
    Route::post('/order/place', [OrderController::class, 'orderPlace'])->name('customer.order.place');
    Route::get('/order/{order}/details', [OrderController::class, 'orderDetails'])->name('customer.order.details');

    //customer dashboard
    Route::get('/dashboard', [CustomerDashboardController::class, 'dashboard'])->name('customer.dashboard');

    //customer profile
    Route::get('/profile', [ProfileController::class, 'profilePage'])->name('customer.profile');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('customer.profile.update');


    //customer wishlist
    Route::get('/wishlist', [WishListController::class, 'index'])->name('customer.wishlist.index');
    Route::post('/wishlist', [WishListController::class, 'store'])->name('customer.wishlist.store');
    Route::get('/wishlist/{productId}/remove', [WishListController::class, 'destroy'])->name('customer.wishlist.destroy');


    //customer address
    Route::get('/address', [AddressController::class, 'index'])->name('customer.address');
    Route::get('/address/save',[AddressController::class,'addressSavePage'])->name('customer.address.save.page');
    Route::post('/address', [AddressController::class, 'store'])->name('customer.address.store');
    Route::post('/address/{address}/update', [AddressController::class, 'update'])->name('customer.address.update');

});

