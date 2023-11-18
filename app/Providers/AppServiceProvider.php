<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Helper function to map user roles to strings
        function mapUserRoleToString($role) {
            $roleMapping = [
                0 => 'Client',
                1 => 'Admin',
                2 => 'Worker',
                3 => 'Driver',
            ];

            return $roleMapping[$role] ?? '';
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
