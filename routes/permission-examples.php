<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Protected Routes with Spatie Permission
|--------------------------------------------------------------------------
|
| These routes demonstrate how to protect routes using Spatie permissions.
| You can use middleware, @can directives, or policies.
|
*/

// Admin Routes - Protected by permissions
Route::middleware(['auth', 'permission:view-admin-dashboard'])->prefix('admin')->name('admin.')->group(function () {
    
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User Management
    Route::middleware(['permission:view-users'])->group(function () {
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::get('/users/create', [AdminController::class, 'createUser'])->middleware('permission:create-users')->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->middleware('permission:create-users')->name('users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->middleware('permission:edit-users')->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->middleware('permission:edit-users')->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->middleware('permission:delete-users')->name('users.destroy');
    });
    
    // Brand Management
    Route::middleware(['permission:view-brands'])->group(function () {
        Route::get('/brands', [BrandsController::class, 'index'])->name('brands.index');
        Route::get('/brands/create', [BrandsController::class, 'create'])->middleware('permission:create-brands')->name('brands.create');
        Route::post('/brands', [BrandsController::class, 'store'])->middleware('permission:create-brands')->name('brands.store');
        Route::get('/brands/{brand}/edit', [BrandsController::class, 'edit'])->middleware('permission:edit-brands')->name('brands.edit');
        Route::put('/brands/{brand}', [BrandsController::class, 'update'])->middleware('permission:edit-brands')->name('brands.update');
        Route::delete('/brands/{brand}', [BrandsController::class, 'destroy'])->middleware('permission:delete-brands')->name('brands.destroy');
    });
    
    // Category Management
    Route::middleware(['permission:view-categories'])->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->middleware('permission:create-categories')->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->middleware('permission:create-categories')->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->middleware('permission:edit-categories')->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->middleware('permission:edit-categories')->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->middleware('permission:delete-categories')->name('categories.destroy');
    });
    
    // Product Management (Admin sees all products)
    Route::middleware(['permission:view-products'])->group(function () {
        Route::get('/products', [ProductsController::class, 'adminIndex'])->name('products.index');
        Route::get('/products/{product}', [ProductsController::class, 'show'])->name('products.show');
        Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->middleware('permission:delete-products')->name('products.destroy');
    });
    
    // Slider Management
    Route::middleware(['permission:view-sliders'])->group(function () {
        Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
        Route::get('/sliders/create', [SliderController::class, 'create'])->middleware('permission:create-sliders')->name('sliders.create');
        Route::post('/sliders', [SliderController::class, 'store'])->middleware('permission:create-sliders')->name('sliders.store');
        Route::get('/sliders/{slider}/edit', [SliderController::class, 'edit'])->middleware('permission:edit-sliders')->name('sliders.edit');
        Route::put('/sliders/{slider}', [SliderController::class, 'update'])->middleware('permission:edit-sliders')->name('sliders.update');
        Route::delete('/sliders/{slider}', [SliderController::class, 'destroy'])->middleware('permission:delete-sliders')->name('sliders.destroy');
    });
    
    // Order Management (Admin sees all orders)
    Route::middleware(['permission:view-all-orders'])->group(function () {
        Route::get('/orders', [OrdersController::class, 'adminIndex'])->name('orders.index');
        Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}/status', [OrdersController::class, 'updateStatus'])->middleware('permission:update-order-status')->name('orders.update-status');
    });
    
    // Customer Management
    Route::middleware(['permission:view-customers'])->group(function () {
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    });
});

// Vendor Routes - Protected by permissions
Route::middleware(['auth', 'permission:view-vendor-dashboard'])->prefix('vendor')->name('vendor.')->group(function () {
    
    // Vendor Dashboard
    Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
    
    // Vendor's Own Products
    Route::middleware(['permission:view-own-products'])->group(function () {
        Route::get('/products', [VendorController::class, 'products'])->name('products.index');
        Route::get('/products/create', [VendorController::class, 'createProduct'])->middleware('permission:create-products')->name('products.create');
        Route::post('/products', [VendorController::class, 'storeProduct'])->middleware('permission:create-products')->name('products.store');
        Route::get('/products/{product}/edit', [VendorController::class, 'editProduct'])->middleware('permission:edit-products')->name('products.edit');
        Route::put('/products/{product}', [VendorController::class, 'updateProduct'])->middleware('permission:edit-products')->name('products.update');
        Route::delete('/products/{product}', [VendorController::class, 'destroyProduct'])->middleware('permission:delete-products')->name('products.destroy');
    });
    
    // Vendor's Orders
    Route::middleware(['permission:view-own-orders'])->group(function () {
        Route::get('/orders', [VendorController::class, 'orders'])->name('orders.index');
        Route::get('/orders/{order}', [VendorController::class, 'showOrder'])->name('orders.show');
        Route::put('/orders/{order}/status', [VendorController::class, 'updateOrderStatus'])->middleware('permission:update-order-status')->name('orders.update-status');
    });
    
    // Vendor Profile
    Route::get('/profile', [VendorController::class, 'profile'])->middleware('permission:edit-profile')->name('profile');
    Route::put('/profile', [VendorController::class, 'updateProfile'])->middleware('permission:edit-profile')->name('profile.update');
});

// Customer/User Routes - Protected by permissions
Route::middleware(['auth'])->group(function () {
    
    // User Profile
    Route::middleware(['permission:view-profile'])->group(function () {
        Route::get('/profile', [CustomerController::class, 'profile'])->name('user.profile');
        Route::put('/profile', [CustomerController::class, 'updateProfile'])->middleware('permission:edit-profile')->name('user.profile.update');
    });
    
    // Shopping Features
    Route::middleware(['permission:add-to-cart'])->group(function () {
        Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::put('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');
    });
    
    // Wishlist
    Route::middleware(['permission:view-wishlist'])->group(function () {
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
        Route::delete('/wishlist/{item}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    });
    
    // Orders
    Route::middleware(['permission:place-orders'])->group(function () {
        Route::get('/checkout', [OrdersController::class, 'checkout'])->name('checkout');
        Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');
    });
    
    Route::get('/orders', [OrdersController::class, 'userOrders'])->name('user.orders');
    Route::get('/orders/{order}', [OrdersController::class, 'userOrderShow'])->name('user.orders.show');
});

// Example of using role-based middleware (alternative approach)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Admin only routes using role middleware
});

Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->group(function () {
    // Vendor only routes using role middleware
});

Route::middleware(['auth', 'role:user'])->prefix('customer')->group(function () {
    // Customer only routes using role middleware
});