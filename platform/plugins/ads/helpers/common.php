<?php

use Woo\Ads\Repositories\Interfaces\AdsInterface;

if (! function_exists('generate_ads_key')) {
    function generate_ads_key(): string
    {
        $adsRepository = app(AdsInterface::class);

        do {
            $key = strtoupper(Str::random(12));
        } while ($adsRepository->count(compact('key')) > 0);

        return $key;
    }
}
