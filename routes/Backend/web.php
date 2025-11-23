<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductDetailController;
use App\Http\Controllers\Admin\ProductReviewController;



Route::group(['prefix' => 'admin', 'middleware' =>['auth', 'admin']], function () {

    //users
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/save', [UserController::class, 'userSavePage'])->name('user.save.page');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    //brands
    Route::get('/brands', [BrandController::class, 'index'])->name('brand.index');
    Route::post('/brand', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/save', [BrandController::class, 'brandSavePage'])->name('brand.save.page');
    Route::post('/brand/{brand}', [BrandController::class, 'update'])->name('brand.update');
    Route::get('/brand/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');

    //categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/save', [CategoryController::class, 'categorySavePage'])->name('category.save.page');
    Route::post('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    //products
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/save', [ProductController::class, 'productSavePage'])->name('product.save.page');
    Route::post('/product/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

    //product details
    Route::get('/products/details', [ProductDetailController::class, 'index'])->name('product.details');
    Route::post('/products/details', [ProductDetailController::class, 'store'])->name('product.detail.store');
    Route::get('/products/details/save', [ProductDetailController::class, 'productDetailSavePage'])->name('product.detail.save.page');
    Route::post('/products/{productDetail}/details', [ProductDetailController::class, 'update'])->name('product.detail.update');
    Route::get('/products/{productDetail}/details', [ProductDetailController::class, 'destroy'])->name('product.detail.destroy');


    //product reviews
    Route::get('/products/reviews', [ProductReviewController::class, 'index'])->name('product.reviews');
    Route::post('/products/reviews', [ProductReviewController::class, 'store'])->name('product.review.store');
    Route::get('/products/reviews/save', [ProductReviewController::class, 'productReviewSavePage'])->name('product.review.save.page');
    Route::post('/products/{productReview}/reviews', [ProductReviewController::class, 'update'])->name('product.review.update');
    Route::get('/products/{productReview}/reviews', [ProductReviewController::class, 'destroy'])->name('product.review.destroy');

    //orders
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/{order}/details', [OrderController::class, 'orderDetails'])->name('order.details');
    Route::get('/order/{order}/edit', [OrderController::class, 'edit'])->name('order.edit');

    //sliders
    Route::get('/sliders', [SliderController::class, 'index'])->name('slider.index');
    Route::post('/slider', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/slider/save', [SliderController::class, 'sliderSavePage'])->name('slider.save.page');
    Route::post('/slider/{slider}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('/slider/{slider}', [SliderController::class, 'destroy'])->name('slider.destroy');

    //coupons
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupon.index');
    Route::post('/coupon', [CouponController::class, 'store'])->name('coupon.store');
    Route::get('/coupon/save', [CouponController::class, 'couponSavePage'])->name('coupon.save.page');
    Route::post('/coupon/{coupon}', [CouponController::class, 'update'])->name('coupon.update');
    Route::get('/coupon/{coupon}', [CouponController::class, 'destroy'])->name('coupon.destroy');
});
