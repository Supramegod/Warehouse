<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Item;
use App\Observers\BarangObserver;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Item::observe(BarangObserver::class);
    }
}
