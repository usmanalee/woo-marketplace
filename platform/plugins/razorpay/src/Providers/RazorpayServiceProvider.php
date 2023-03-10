<?php

namespace Woo\Razorpay\Providers;

use Woo\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\ServiceProvider;

class RazorpayServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @throws FileNotFoundException
     */
    public function boot(): void
    {
        if (is_plugin_active('payment')) {
            $this->setNamespace('plugins/razorpay')
                ->loadHelpers()
                ->loadAndPublishViews()
                ->publishAssets();

            $this->app->register(HookServiceProvider::class);
        }
    }
}
