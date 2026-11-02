<?php

use App\Http\Controllers\Admin\Content\BannerController;
use App\Http\Controllers\Admin\Content\BlogController;
use App\Http\Controllers\Admin\Content\CityController;
use App\Http\Controllers\Admin\Content\CommentController;
use App\Http\Controllers\Admin\Content\FaqController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\Content\ProvinceController;
use App\Http\Controllers\Admin\Content\SliderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\CopanController;
use App\Http\Controllers\Admin\Market\DeliveryController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Market\ProductCategoryController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Market\ProductImageController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Ticket\TicketAdminController;
use App\Http\Controllers\Admin\Ticket\TicketCategoryController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\CheckoutController;
use App\Http\Controllers\Home\CommentController as HomeCommentController;
use App\Http\Controllers\Home\Customer\AddressController;
use App\Http\Controllers\Home\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Home\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\OrderController;
use App\Http\Controllers\ProfileController;
use App\Models\Market\ProductImage;
use App\Services\SmsService;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/product/{product}', [HomeController::class, 'show'])->name('product');

Route::middleware('auth')->group(function(){
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::patch('/cart/decrease/{id}', [CartController::class, 'decreaseItem'])->name('cart.decrease');
    
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/checkout/apply-discount', [CheckoutController::class, 'applyDiscount'])->name('checkout.apply-discount');

    Route::post('order-submit', [OrderController::class, 'storeOrder'])->name('order-submit');

    Route::post('/product/{product}/add-comment', [HomeCommentController::class, 'storeProductComment'])->name('product.add-comment');

});

Route::get('/get-cities/{province}', [AddressController::class, 'getCities'])->name('get-cities');


Route::middleware('auth')->prefix('profile')->name('profile.')->group(function(){
    Route::get('/', [CustomerProfileController::class, 'showProfile'])->name('show');
    Route::resource('address', AddressController::class);
    Route::get('my-orders/{order_status?}', [CustomerOrderController::class, 'index'])->name('my-orders');
});

require __DIR__.'/auth.php';

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function(){

    Route::get('/', DashboardController::class);

    Route::prefix('setting')->name('setting.')->group(function(){
        Route::get('', [SettingController::class, 'index']);
        Route::get('/set', [SettingController::class, 'set'])->name('set');
        Route::post('/set/store', [SettingController::class, 'setStore'])->name('set.store');
    });

    Route::prefix('content')->name('content.')->group(function(){
       Route::resource('menu', MenuController::class); 
       Route::resource('faq', FaqController::class); 
       Route::resource('page', PageController::class); 
       Route::resource('comment', CommentController::class);
       Route::get('comment/{comment}/change-status', [CommentController::class, 'changeStatus'])->name('comment.change-status');
       Route::resource('blog', BlogController::class);
       Route::resource('slider', SliderController::class);
       Route::resource('banner', BannerController::class);
       Route::resource('city', CityController::class);
       Route::resource('province', ProvinceController::class);
    });

    Route::prefix('tickets')->name('tickets.')->group(function() {
        Route::resource('ticket-category', TicketCategoryController::class);
        Route::resource('ticket-admin', TicketAdminController::class);
        Route::resource('ticket', TicketController::class);
        Route::post('/change-status/{ticket}', [TicketController::class, 'changeStatus'])->name('ticket.change-status');
    });

    Route::prefix('market')->name('market.')->group(function(){
        Route::resource('product-category', controller: ProductCategoryController::class);
        Route::resource('brand', BrandController::class);
        Route::resource('product', ProductController::class);
        Route::get('product-image/{product}', [ProductImageController::class, 'index'])->name('product-image.index');
        Route::get('product-image/{product}/create', [ProductImageController::class, 'create'])->name('product-image.create');
        Route::post('product-image/{product}/', [ProductImageController::class, 'store'])->name('product-image.store');
        Route::get('product-image/{product}/{productImage}/edit', [ProductImageController::class, 'edit'])->name('product-image.edit');
        Route::put('product-image/{product}/{productImage}/', [ProductImageController::class, 'update'])->name('product-image.update');
        Route::delete('product-image/{product}/{productImage}/', [ProductImageController::class, 'destroy'])->name('product-image.destroy');
        Route::resource('copan', CopanController::class);
        Route::resource('delivery', DeliveryController::class);
        Route::resource('payment', PaymentController::class);
    });

});

Route::prefix('customer')->name('customer.')->group(function(){
    Route::resource('address', AddressController::class);
});
