<?php

namespace Woo\Ecommerce\Http\Controllers\Fronts;

use Woo\Base\Http\Responses\BaseHttpResponse;
use Woo\Ecommerce\Repositories\Interfaces\CurrencyInterface;
use Illuminate\Http\Request;

class PublicEcommerceController
{
    protected CurrencyInterface $currencyRepository;

    public function __construct(CurrencyInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function changeCurrency(Request $request, BaseHttpResponse $response, ?string $title = null)
    {
        if (empty($title)) {
            $title = $request->input('currency');
        }

        if (! $title) {
            return $response;
        }

        $currency = $this->currencyRepository->getFirstBy(['title' => $title]);

        if ($currency) {
            cms_currency()->setApplicationCurrency($currency);
        }

        return $response;
    }
}
