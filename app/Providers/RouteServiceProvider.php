<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = [
        'admin' => 'admin/dashboard',
        'doctor' => 'doctor/dashboard',
        'patient' => 'patient/dashboard',
        'rayEmployee' => 'rayEmployee/dashboard',
        'labEmployee' => 'labEmployee/dashboard',
    ];

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')->prefix('api')->group(base_path('routes/api.php'));

            Route::middleware('web')->group(base_path('routes/web.php'));

            Route::middleware('web')->group(base_path('routes/users/admin.php'));

            Route::middleware('web')->group(base_path('routes/users/doctor.php'));

            Route::middleware('web')->group(base_path('routes/users/labEmployee.php'));

            Route::middleware('web')->group(base_path('routes/users/rayEmployee.php'));

            Route::middleware('web')->group(base_path('routes/users/patient.php'));
        });
    }
}
