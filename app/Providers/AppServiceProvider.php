<?php

namespace App\Providers;

use App\Http\Resources\Kabupaten\KabupatenCollection;
use App\Http\Resources\Kabupaten\KabupatenResource;
use App\Http\Resources\Provinsi\ProvinsiCollection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        KabupatenCollection::withoutWrapping();
        KabupatenResource::withoutWrapping();
        ProvinsiCollection::withoutWrapping();
    }
}
