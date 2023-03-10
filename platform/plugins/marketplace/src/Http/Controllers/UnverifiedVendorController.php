<?php

namespace Woo\Marketplace\Http\Controllers;

use Assets;
use Woo\Base\Events\UpdatedContentEvent;
use Woo\Base\Http\Controllers\BaseController;
use Woo\Base\Http\Responses\BaseHttpResponse;
use Woo\Ecommerce\Repositories\Interfaces\CustomerInterface;
use Woo\Marketplace\Tables\UnverifiedVendorTable;
use Carbon\Carbon;
use EmailHandler;
use Illuminate\Http\Request;
use MarketplaceHelper;

class UnverifiedVendorController extends BaseController
{
    protected CustomerInterface $customerRepository;

    public function __construct(CustomerInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index(UnverifiedVendorTable $table)
    {
        page_title()->setTitle(trans('plugins/marketplace::unverified-vendor.name'));

        return $table->renderTable();
    }

    public function view(int $id)
    {
        $vendor = $this->customerRepository->getFirstBy([
            'id' => $id,
            'is_vendor' => true,
            'vendor_verified_at' => null,
        ]);

        if (! $vendor) {
            abort(404);
        }

        page_title()->setTitle(trans('plugins/marketplace::unverified-vendor.verify', ['name' => $vendor->name]));

        Assets::addScriptsDirectly(['vendor/core/plugins/marketplace/js/marketplace-vendor.js']);

        return view('plugins/marketplace::customers.verify-vendor', compact('vendor'));
    }

    public function approveVendor(int $id, Request $request, BaseHttpResponse $response)
    {
        $vendor = $this->customerRepository
            ->getFirstBy([
                'id' => $id,
                'is_vendor' => true,
                'vendor_verified_at' => null,
            ]);

        if (! $vendor) {
            abort(404);
        }

        $vendor->vendor_verified_at = Carbon::now();
        $vendor->save();

        event(new UpdatedContentEvent(CUSTOMER_MODULE_SCREEN_NAME, $request, $vendor));

        if (MarketplaceHelper::getSetting('verify_vendor', 1) && ($vendor->store->email || $vendor->email)) {
            EmailHandler::setModule(MARKETPLACE_MODULE_SCREEN_NAME)
                ->setVariableValues([
                    'store_name' => $vendor->store->name,
                ])
                ->sendUsingTemplate('vendor-account-approved', $vendor->store->email ?: $vendor->email);
        }

        return $response
            ->setPreviousUrl(route('marketplace.unverified-vendors.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }
}
