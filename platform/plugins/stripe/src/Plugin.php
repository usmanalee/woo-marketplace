<?php

namespace Woo\Stripe;

use Woo\PluginManagement\Abstracts\PluginOperationAbstract;
use Woo\Setting\Models\Setting;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Setting::query()
            ->whereIn('key', [
                'payment_stripe_payment_type',
                'payment_stripe_name',
                'payment_stripe_description',
                'payment_stripe_client_id',
                'payment_stripe_secret',
                'payment_stripe_status',
            ])
            ->delete();
    }
}
