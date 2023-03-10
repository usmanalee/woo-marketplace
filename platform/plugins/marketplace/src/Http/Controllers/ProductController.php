<?php

namespace Woo\Marketplace\Http\Controllers;

use Woo\Base\Enums\BaseStatusEnum;
use Woo\Base\Http\Controllers\BaseController;
use Woo\Base\Http\Responses\BaseHttpResponse;
use Woo\Ecommerce\Repositories\Interfaces\ProductInterface;
use EmailHandler;
use MarketplaceHelper;

class ProductController extends BaseController
{
    public function approveProduct(int $id, ProductInterface $productRepository, BaseHttpResponse $response)
    {
        $product = $productRepository->findOrFail($id);

        $product->status = BaseStatusEnum::PUBLISHED;
        $product->approved_by = auth()->id();

        $product->save();

        if (MarketplaceHelper::getSetting('enable_product_approval', 1)) {
            $store = $product->store;

            EmailHandler::setModule(MARKETPLACE_MODULE_SCREEN_NAME)
                ->setVariableValues([
                    'store_name' => $store->name,
                ])
                ->sendUsingTemplate('product-approved', $store->email);
        }

        return $response->setMessage(trans('plugins/marketplace::store.approve_product_success'));
    }
}
