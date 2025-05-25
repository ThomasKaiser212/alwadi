<?php

namespace App\Providers;

use App\Models\Meal;
use Illuminate\Support\ServiceProvider;
use App\Models\Room;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'Room' => Room::class,
            'Meal' => Meal::class
        ]);
    }
}
