<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class PermissionHelper
{
    /**
     * Check if the current user can access admin features
     */
    public static function canAccessAdmin()
    {
        return Auth::check() && Auth::user()->hasRole('admin');
    }

    /**
     * Check if the current user can access vendor features
     */
    public static function canAccessVendor()
    {
        return Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('vendor'));
    }

    /**
     * Check if the current user is a regular customer
     */
    public static function isCustomer()
    {
        return Auth::check() && Auth::user()->hasRole('user');
    }

    /**
     * Get user's primary role
     */
    public static function getUserRole()
    {
        if (Auth::check()) {
            $roles = Auth::user()->getRoleNames();
            return $roles->first();
        }
        return null;
    }

    /**
     * Generate navigation menu based on user permissions
     */
    public static function getNavigation()
    {
        $navigation = [];

        if (Auth::check()) {
            $user = Auth::user();

            // Admin navigation
            if ($user->can('view-admin-dashboard')) {
                $navigation['admin'] = [
                    'Dashboard' => route('admin.dashboard'),
                    'Users' => $user->can('view-users') ? route('admin.users.index') : null,
                    'Brands' => $user->can('view-brands') ? route('admin.brands.index') : null,
                    'Categories' => $user->can('view-categories') ? route('admin.categories.index') : null,
                    'Products' => $user->can('view-products') ? route('admin.products.index') : null,
                    'Sliders' => $user->can('view-sliders') ? route('admin.sliders.index') : null,
                    'Orders' => $user->can('view-all-orders') ? route('admin.orders.index') : null,
                    'Customers' => $user->can('view-customers') ? route('admin.customers.index') : null,
                    'Reports' => $user->can('view-reports') ? route('admin.reports.index') : null,
                    'Settings' => $user->can('view-settings') ? route('admin.settings.index') : null,
                ];
            }

            // Vendor navigation
            if ($user->can('view-vendor-dashboard')) {
                $navigation['vendor'] = [
                    'Dashboard' => route('vendor.dashboard'),
                    'My Products' => $user->can('view-own-products') ? route('vendor.products.index') : null,
                    'My Orders' => $user->can('view-own-orders') ? route('vendor.orders.index') : null,
                    'Profile' => $user->can('edit-profile') ? route('vendor.profile') : null,
                ];
            }

            // Customer navigation
            if ($user->hasRole('user')) {
                $navigation['customer'] = [
                    'Profile' => route('user.profile'),
                    'Orders' => route('user.orders'),
                    'Wishlist' => route('user.wishlist'),
                ];
            }
        }

        return array_filter($navigation, function($section) {
            return !empty(array_filter($section));
        });
    }
}