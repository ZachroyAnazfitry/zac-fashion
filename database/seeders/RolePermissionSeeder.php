<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Permissions
        $permissions = [
            // Dashboard permissions
            'view-dashboard',
            'view-admin-dashboard',
            'view-vendor-dashboard',

            // User management
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',

            // Brand management
            'view-brands',
            'create-brands',
            'edit-brands',
            'delete-brands',

            // Category management
            'view-categories',
            'create-categories',
            'edit-categories',
            'delete-categories',

            // Product management
            'view-products',
            'create-products',
            'edit-products',
            'delete-products',
            'view-own-products', // Vendors can only see their own products

            // Slider management
            'view-sliders',
            'create-sliders',
            'edit-sliders',
            'delete-sliders',

            // Order management
            'view-orders',
            'view-all-orders',
            'view-own-orders', // Vendors see their own orders
            'update-order-status',

            // Customer management
            'view-customers',
            'edit-customers',

            // Reports
            'view-reports',
            'view-sales-reports',

            // Settings
            'view-settings',
            'edit-settings',

            // Shopping features (for regular users)
            'add-to-cart',
            'view-wishlist',
            'place-orders',
            'view-profile',
            'edit-profile',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create Roles
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $vendorRole = Role::create(['name' => 'vendor', 'guard_name' => 'web']);
        $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);

        // Admin gets all permissions
        $adminRole->givePermissionTo(Permission::all());

        // Vendor permissions
        $vendorPermissions = [
            'view-dashboard',
            'view-vendor-dashboard',
            'view-own-products',
            'create-products',
            'edit-products',
            'delete-products',
            'view-own-orders',
            'update-order-status',
            'view-profile',
            'edit-profile',
            'view-customers', // Can see customers who bought their products
        ];
        $vendorRole->givePermissionTo($vendorPermissions);

        // User permissions (customers)
        $userPermissions = [
            'add-to-cart',
            'view-wishlist',
            'place-orders',
            'view-profile',
            'edit-profile',
        ];
        $userRole->givePermissionTo($userPermissions);

        // Assign roles to existing users
        $admin = User::where('email', 'admin@gmail.com')->first();
        if ($admin) {
            $admin->assignRole('admin');
        }

        $vendor = User::where('email', 'vendor@gmail.com')->first();
        if ($vendor) {
            $vendor->assignRole('vendor');
        }

        $user = User::where('email', 'user@gmail.com')->first();
        if ($user) {
            $user->assignRole('user');
        }
    }
}
