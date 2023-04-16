<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('landing-page');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');


// create middleware route, check if logged in
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class,'profile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminController::class, 'editProfile'])->name('admin.edit');
    Route::post('/admin/profile/store', [AdminController::class,'storeProfile'])->name('store.profile');
    Route::get('/admin/profile/change-password',[AdminController::class,'changePasswordProfile'])->name('change.password');
    Route::post('/admin/profile/update-password-profile', [AdminController::class, 'updatePasswordProfile'])->name('password.profile');
    Route::get('/admin/manage/vendor',[AdminController::class, 'manageVendor'])->name('admin.manage_vendor');
    Route::get('/admin/vendor/details/{id}',[AdminController::class, 'detailsVendor'])->name('admin.details_vendor');
    Route::post('/admin/activate/vendor/{id}',[AdminController::class, 'activateVendor'])->name('admin.activate_vendor');
    Route::get('/admin/active/vendor/details/{id}',[AdminController::class, 'detailsActiveVendor'])->name('admin.details_active_vendor');
    Route::post('/admin/deactivate/vendor/{id}',[AdminController::class, 'deactivateVendor'])->name('admin.deactivate_vendor');


    // Brand - calling BrandController once
    Route::controller(BrandsController::class)->group(function () {
        Route::get('/brands', 'brands')->name('brands');
        Route::post('/brands/new', 'storeNewBrands')->name('brands.new');
        Route::get('/brands/edit/{id}', 'editNewBrands')->name('brands.edit');
        Route::put('/brands/update/{id}', 'updateNewBrands')->name('brands.update');
        Route::get('/brands/delete/{id}', 'deleteNewBrands')->name('brands.delete');

    
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'showCategory')->name('category');
        Route::get('/category/add', 'addCategory')->name('category.add');
        Route::post('/category/store', 'storeCategory')->name('category.store');
        Route::get('/category/edit/{id}', 'editCategory')->name('category.edit');
        Route::put('/category/update/{id}', 'updateNewCategory')->name('category.update');
        Route::get('/category/delete/{id}', 'deleteCategory')->name('category.delete');

    });

    // Products
    Route::controller(ProductsController::class)->group(function () {
        Route::get('/products', 'manage')->name('products.manage');
        Route::get('/products/new', 'newProducts')->name('products.new');
        Route::post('/products/store', 'storeProducts')->name('products.store');
        Route::get('/products/see/{id}', 'seeProducts')->name('products.see');
        Route::get('/products/edit/{id}', 'editProducts')->name('products.edit');
        Route::put('/products/update/{id}', 'updateProducts')->name('products.update');
        Route::put('/products/update/images/{id}', 'updateProductsImages')->name('products.update.images');
        Route::put('/products/update/multi/images/{id}', 'updateProductsMultiImages')->name('products.update.multi.images');
        Route::get('/products/inactive/{id}', 'inactiveProducts')->name('products.inactive');
        Route::get('/products/active/{id}', 'activeProducts')->name('products.active');
        Route::get('/products/delete/{id}', 'deleteProducts')->name('products.delete');
        Route::get('/products/delete/multi/images/{id}', 'deleteProductsMultiImages')->name('products.delete.multi.images');
    });

    // Slider
    Route::controller(SliderController::class)->group(function () {
        Route::get('/slider', 'showSlider')->name('slider');
        Route::get('/slider/add', 'addSlider')->name('slider.add');
        Route::post('/slider/store', 'storeSlider')->name('slider.store');
        Route::get('/slider/edit/{id}', 'editslider')->name('slider.edit');
        Route::put('/slider/update/{id}', 'updateNewSlider')->name('slider.update');
        Route::get('/slider/delete/{id}', 'deleteSlider')->name('slider.delete');
    });

    // Orders
    Route::controller(OrdersController::class)->group(function () {
        Route::get('/orders', 'showOrders')->name('orders');
        
    });
    
});

// Vendor routes
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout',[VendorController::class, 'vendorLogout'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class,'vendorProfile'])->name('vendor.profile');
    Route::get('/vendor/profile/edit', [VendorController::class,'editVendorProfile'])->name('vendor.edit');
    Route::post('/vendor/profile/store', [VendorController::class,'storeVendorProfile'])->name('store.vendorProfile');
    // Route::get('/vendor/profile/change-password',[VendorController::class])->name('change.password');
    // Route::post('/vendor/profile/update-password-profile', [VendorController::class])->name('password.profile');


    // Vendor Products management
    Route::controller(VendorProductsController::class)->group(function () {
        Route::get('/vendor/products', 'allProducts')->name('vendor.all.products');
        Route::get('/vendor/new/products', 'newProducts')->name('vendor.add.products');
        Route::post('/vendor/store/products', 'storeProducts')->name('vendor.store.products');
        Route::get('/vendor/see/products/{id}', 'seeProducts')->name('vendor.see.products');
        Route::get('/vendor/edit/products/{id}', 'editProducts')->name('vendor.edit.products');
        Route::put('/vendor/update/products/{id}', 'updateProducts')->name('vendor.update.products');
        Route::get('/vendor/inactive/products/{id}', 'inactiveProducts')->name('vendor.inactive.products');
        Route::get('/vendor/active/products/{id}', 'activeProducts')->name('vendor.active.products');
        Route::get('/vendor/delete/products/{id}', 'deleteProducts')->name('vendor.delete.products');
        
    });

    // Orders
    Route::controller(OrdersController::class)->group(function () {
        Route::get('/vendor/orders', 'showOrdersVendor')->name('vendor.orders');
        
    });

});

// Customer routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/customer/home', [CustomerController::class, 'customerPage'])->name('customer.home');
    Route::get('/customer/logout',[CustomerController::class, 'destroy'])->name('customer.logout');
    Route::get('/customer/profile',[CustomerController::class, 'customerProfile'])->name('customer.profile');
    Route::put('/customer/profile/edit',[CustomerController::class, 'customerEditProfile'])->name('customer.edit');
    Route::get('/customer/wishlist', [WishlistController::class, 'customerWishlist'])->name('customer.wishlist');
    Route::get('/get/wishlist', [WishlistController::class, 'getWishlist']);
    Route::get('/wishlist/remove/{id}', [WishlistController::class, 'removeWishlist']);
    Route::get('/customer/mycart', [CartController::class, 'myCart'])->name('mycart');
    Route::get('/cart-page', [CartController::class, 'getCart']);
    Route::get('/cart/remove/{rowId}', [CartController::class, 'removeCart']);
    Route::get('/checkout', [CartController::class, 'checkoutProducts'])->name('checkout');
    Route::get('/checkout/store', [CartController::class, 'checkoutStore'])->name('checkout.store');
    Route::post('/checkout/stripe', [StripeController::class, 'checkoutStripe'])->name('checkout.stripe.order');
    Route::post('/checkout/cash', [StripeController::class, 'checkoutCash'])->name('checkout.cash.order');





    
});

// login page for the 3 roles without authentication permission
// Route::get('/admin/login',[AdminController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/vendor/login', [VendorController::class, 'vendorLogin'])->name('vendor.login');
Route::get('/vendor/register', [VendorController::class, 'vendorRegister'])->name('vendor.register');
Route::post('/vendor/new/register', [VendorController::class, 'vendorNewRegister'])->name('vendor.newRegister');

Route::get('/customer/register', [CustomerController::class, 'customerRegister'])->name('customer.register');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Landing page routes
Route::get('/shop', [ShopController::class, 'viewShop'])->name('shop.products');
Route::get('/category/details/all', [ShopController::class, 'allCategory']);
Route::get('/category/details/{id}/{slug}', [ShopController::class, 'oneCategory']);
Route::get('/products/details/{id}', [ShopController::class, 'oneProducts']);
Route::get('/vendor/details/{id}', [ShopController::class, 'oneVendor']);

// Bumbummen Shopping Cart routes
Route::get('product/view/modal/{id}', [ShopController::class, 'eyeProducts']);
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);
Route::get('/cart/data/show', [CartController::class, 'miniCart']);
Route::get('/cart/data/remove/{id}', [CartController::class, 'cartRemove']);

// Wishlist routes
Route::post('/wishlist/{product_id}', [WishlistController::class, 'wishlist']);


require __DIR__.'/auth.php';
