<?php

use App\Http\Controllers\V1\AuthenticationsController;
use App\Http\Controllers\V1\BannerController;
use App\Http\Controllers\V1\BrandsController;
use App\Http\Controllers\V1\CartController;
use App\Http\Controllers\V1\CategoriesController;
use App\Http\Controllers\V1\CouponController;
use App\Http\Controllers\V1\CustomersController;
use App\Http\Controllers\V1\DeliveryController;
use App\Http\Controllers\V1\OrderController;
use App\Http\Controllers\V1\OrderDetailsController;
use App\Http\Controllers\V1\OrderItemsController;
use App\Http\Controllers\V1\ProductsController;
use App\Http\Controllers\V1\ProductVariationController;
use App\Http\Controllers\V1\ReviewController;
use App\Http\Controllers\V1\SubscriptionController;
use App\Http\Controllers\V1\TestimonyController;
use App\Http\Controllers\V1\TransactionController;
use App\Http\Controllers\V1\WishlistsController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function (){
    //todo public routes
        //todo public customer route
        Route::controller(CustomersController::class)->group(function (){
            Route::get('/read-customer', 'read');
            Route::post('/read-customer-by-id', 'readById');


        });
        //todo public authentication route
        Route::controller(AuthenticationsController::class)
            ->group(function (){
                Route::post('/initiate-enrollment', 'initiateEnrollment');
                Route::post('/complete-enrollment', 'completeEnrollment');
                Route::post('/initiate-forgotten-password', 'initiateForgottenPassword');
                Route::post('/complete-forgotten-password', 'completeForgottenPassword');
                Route::post('/change-password', 'changePassword');
                Route::post('/login', 'login');
                Route::post('/resend-otp', 'resendOtp');
            });
    //todo public product route
        Route::controller(ProductsController::class)
            ->group(function (){
                Route::post('/create-product', 'create')->name("createProduct");
                Route::post('/update-product', 'update')->name("updateProduct");
                Route::get('/read-products', 'read')->name("readProduct");
                Route::post('/read-product-by-id', 'readById')->name("readByIdProduct");
                Route::post('/read-product-by-brand-id', 'readProductByBrandId')->name("readProductByBrandId");
                Route::post('/read-product-by-category-id', 'readProductByCategoryId')->name("readProductByCategoryId");
                Route::post('/filter-product-by-selling-price', 'filterProductBySellingPrice')->name("filterProductBySellingPrice");
                Route::post('/filter-product-by-offering-price', 'readProductOfferPrice')->name("readProductOfferPrice");
                Route::post('/read-product-by-variations', 'readByProductVariation')->name("readByProductVariation");
                Route::post('/delete-product', 'delete')->name("deleteProduct");
            });
    //todo public category route
        Route::controller(CategoriesController::class)
            ->group(function (){
                Route::post('/create-category', 'create')->name('createCategory');
                Route::post('/update-category', 'update')->name('updateCategory');
                Route::get('/read-categories', 'read')->name('readCategory');
                Route::post('/read-category-by-id', 'readById')->name('readByIdCategory');
                Route::post('/delete-category', 'delete')->name('deleteCategory');
            });

    //todo public wishlist route
    Route::controller(WishlistsController::class)
        ->group(function (){
            Route::post('/create-wishlist', 'create');
            Route::post('/update-wishlist', 'update');
            Route::get('/read-wishlists', 'read');
            Route::post('/read-wishlist-by-id', 'readById');
            Route::post('/delete-wishlist', 'delete');
        });

    //todo delivery route
    Route::controller(DeliveryController::class)->group(function (){
        Route::get('/read-delivery', 'read');
        Route::post('/create-delivery', 'create');
        Route::post('/read-delivery-by-id', 'readById');
        Route::post('/update-delivery', 'update');
    });

    //todo order route
    Route::controller(OrderController::class)->group(function (){
        Route::get('/read-orders', 'read');
        Route::post('/create-order', 'create');
        Route::post('/read-order-by-id', 'readById');
        Route::post('/update-order', 'update');
    });

    //todo orderItems route
    Route::controller(OrderItemsController::class)->group(function (){
        Route::get('/read-order-items', 'read');
        Route::post('/create-order-items', 'create');
        Route::post('/read-order-items-by-id', 'readById');
        Route::post('/read-order-items-by-order-id', 'readByOrderId');
    });

    //todo cart route
    Route::controller(CartController::class)->group(function (){
        Route::post('/create-cart', 'create');
        Route::post('/read-cart-by-customer', 'readByCustomerId');
        Route::post('/update-cart', 'update');
        Route::post('/delete-cart', 'delete');
    });


    //todo public brand route
    Route::controller(BrandsController::class)
        ->group(function (){
            Route::post('/create-brand', 'create')->name('createBrand');
            Route::post('/update-brand', 'update')->name('updateBrand');
            Route::get('/read-brands', 'read')->name('readBrand');
            Route::post('/read-brand-by-id', 'readById')->name('readByIdBrand');
            Route::post('/delete-brand', 'delete')->name('deleteBrand');
        });

    //todo banner route
    Route::controller(BannerController::class)->group(function (){
        Route::get('/read-banners', 'read');
        Route::post('/create-banner', 'create');
        Route::post('/read-banner-by-id', 'readById');
        Route::post('/update-banner', 'update');
    });

    //todo transaction route
    Route::controller(TransactionController::class)->group(function (){
        Route::get('/read-transactions', 'read');
        Route::post('/create-transaction', 'create');
        Route::post('/read-transaction-by-id', 'readById');
    });

    //todo review route
    Route::controller(ReviewController::class)->group(function (){
        Route::get('/read-reviews', 'read');
        Route::post('/create-review', 'create');
        Route::post('/read-review-by-id', 'readById');
        Route::post('/read-product-review', 'readByProductId');
    });

    //todo subscription route
    Route::controller(SubscriptionController::class)->group(function (){
        Route::get('/read-subscriptions', 'read');
        Route::post('/create-subscription', 'create');
        Route::post('/read-subscription-by-id', 'readById');
        Route::post('/read-customer-subscription', 'readByCustomerId');
    });

    //todo testimony route
    Route::controller(TestimonyController::class)->group(function (){
        Route::get('/read-testimonies', 'read');
        Route::post('/create-testimony', 'create');
        Route::post('/read-testimony-by-id', 'readById');
    });



    //todo coupon route
    Route::controller(CouponController::class)->group(function (){
        Route::get('/read-coupons', 'read');
        Route::post('/read-coupon-by-id', 'readById');
        Route::post('/create-coupon', 'create');
        Route::post('/read-by-coupon-code', 'readByCouponCode');
        Route::post('/update-coupon', 'update');
        Route::post('/delete-coupon', 'delete');
    });

    //todo productVariation route
    Route::controller(ProductVariationController::class)->group(function (){
        Route::get('/read-product-variations', 'read');
        Route::post('/create-product-variation', 'create');
        Route::post('/read-product-variation-by-id', 'readById');
        Route::post('/update-product-variation', 'update');
    });

//todo protected routes
    Route::middleware('auth:sanctum')->group(function () {
        //todo authentication protected route
        Route::controller(AuthenticationsController::class)
            ->group(function (){
                Route::post('/change-password', 'changePassword');
            });
        //todo customer protected route
        Route::controller(CustomersController::class)->group(function (){
            Route::post('/update-customer', 'update');
            Route::post('/read-customer-revalidate', 'revalidate');
        });

    });
});


