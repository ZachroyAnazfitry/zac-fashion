# Spatie Laravel Permission Implementation Guide

## Overview
This implementation sets up a comprehensive role and permission system for your Laravel e-commerce application using Spatie Laravel Permission package.

## What's Included

### 1. Roles and Permissions Structure
- **Admin Role**: Full access to all features
- **Vendor Role**: Access to own products, orders, and vendor dashboard
- **User Role**: Customer features like cart, wishlist, orders

### 2. Permissions Categories
- **Dashboard**: `view-dashboard`, `view-admin-dashboard`, `view-vendor-dashboard`
- **User Management**: `view-users`, `create-users`, `edit-users`, `delete-users`
- **Product Management**: `view-products`, `create-products`, `edit-products`, `delete-products`, `view-own-products`
- **Brand/Category Management**: CRUD operations for brands and categories
- **Order Management**: `view-orders`, `view-all-orders`, `view-own-orders`, `update-order-status`
- **Customer Features**: `add-to-cart`, `view-wishlist`, `place-orders`, `view-profile`, `edit-profile`

## Installation Steps

### 1. Install the Package
```bash
composer require spatie/laravel-permission
```

### 2. Run Migrations
```bash
php artisan migrate
```

### 3. Run Seeders
```bash
php artisan db:seed --class=RolePermissionSeeder
```

## Usage Examples

### 1. In Blade Templates

#### Check if user has permission
```blade
@can('view-admin-dashboard')
    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
@endcan

@can('create-products')
    <a href="{{ route('products.create') }}">Add Product</a>
@endcan
```

#### Check if user has role
```blade
@hasrole('admin')
    <p>You are an admin!</p>
@endhasrole

@hasanyrole('admin|vendor')
    <p>You can manage products</p>
@endhasanyrole
```

#### Check multiple permissions
```blade
@canany(['edit-products', 'delete-products'])
    <div class="product-actions">
        @can('edit-products')
            <a href="{{ route('products.edit', $product) }}">Edit</a>
        @endcan
        @can('delete-products')
            <form method="POST" action="{{ route('products.destroy', $product) }}">
                @csrf @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endcan
    </div>
@endcanany
```

### 2. In Controllers

#### Check permissions
```php
public function index()
{
    // Method 1: Using middleware (recommended)
    // Already protected by route middleware
    
    // Method 2: Manual check
    if (!auth()->user()->can('view-products')) {
        abort(403, 'Unauthorized');
    }
    
    return view('admin.products.index');
}

public function store(Request $request)
{
    // Check permission before action
    $this->authorize('create-products');
    
    // Create product logic
}
```

#### Vendor-specific logic
```php
public function vendorProducts()
{
    $user = auth()->user();
    
    if ($user->hasRole('admin')) {
        // Admin sees all products
        $products = Product::all();
    } elseif ($user->hasRole('vendor')) {
        // Vendor sees only their products
        $products = Product::where('vendor_id', $user->id)->get();
    } else {
        abort(403);
    }
    
    return view('products.index', compact('products'));
}
```

### 3. In Routes

#### Using middleware
```php
// Single permission
Route::middleware(['auth', 'permission:view-admin-dashboard'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
});

// Multiple permissions (OR logic)
Route::middleware(['auth', 'permission:edit-products|delete-products'])->group(function () {
    Route::resource('products', ProductController::class);
});

// Role-based middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/settings', [AdminController::class, 'settings']);
});
```

### 4. Dynamic Permission Checking

#### In PHP
```php
// Check if user has permission
if (auth()->user()->can('edit-products')) {
    // Show edit button
}

// Check if user has role
if (auth()->user()->hasRole('vendor')) {
    // Vendor-specific logic
}

// Check if user has any of the roles
if (auth()->user()->hasAnyRole(['admin', 'vendor'])) {
    // Can manage products
}

// Get user's permissions
$permissions = auth()->user()->getAllPermissions();

// Get user's roles
$roles = auth()->user()->getRoleNames();
```

## Advanced Features

### 1. Assigning Roles and Permissions Dynamically

```php
// Assign role to user
$user->assignRole('vendor');

// Remove role from user
$user->removeRole('vendor');

// Give permission directly to user
$user->givePermissionTo('create-products');

// Revoke permission from user
$user->revokePermissionTo('create-products');

// Sync roles (removes all other roles)
$user->syncRoles(['vendor']);

// Sync permissions
$user->syncPermissions(['create-products', 'edit-products']);
```

### 2. Creating New Roles and Permissions

```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// Create new permission
$permission = Permission::create(['name' => 'view-analytics']);

// Create new role
$role = Role::create(['name' => 'manager']);

// Give permission to role
$role->givePermissionTo('view-analytics');

// Assign role to user
$user->assignRole('manager');
```

### 3. Policy Integration

```php
// Create a policy
php artisan make:policy ProductPolicy

// In ProductPolicy
public function update(User $user, Product $product)
{
    return $user->hasPermissionTo('edit-products') && 
           ($user->hasRole('admin') || $product->vendor_id === $user->id);
}

// In controller
public function update(Request $request, Product $product)
{
    $this->authorize('update', $product);
    // Update logic
}

// In blade
@can('update', $product)
    <a href="{{ route('products.edit', $product) }}">Edit</a>
@endcan
```

## Navigation Example

Your navigation will automatically show/hide menu items based on user permissions:

```blade
<nav>
    @can('view-admin-dashboard')
        <a href="{{ route('admin.dashboard') }}">Admin</a>
    @endcan
    
    @can('view-vendor-dashboard')
        @unless(auth()->user()->hasRole('admin'))
            <a href="{{ route('vendor.dashboard') }}">Vendor</a>
        @endunless
    @endcan
    
    @hasrole('user')
        <a href="{{ route('user.profile') }}">Profile</a>
        <a href="{{ route('user.orders') }}">My Orders</a>
    @endhasrole
</nav>
```

## Testing User Permissions

```php
// Login as different users to test
Auth::login(User::where('email', 'admin@gmail.com')->first());
Auth::login(User::where('email', 'vendor@gmail.com')->first());
Auth::login(User::where('email', 'user@gmail.com')->first());

// Check what each user can see/do
```

## Cache Considerations

Spatie Permission caches permissions for performance. Clear cache when changing permissions:

```bash
php artisan permission:cache-reset
```

This implementation gives you a robust, scalable permission system that can grow with your application!