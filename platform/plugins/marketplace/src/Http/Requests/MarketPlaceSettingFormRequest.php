<?php

namespace Woo\Marketplace\Http\Requests;

use Woo\Ecommerce\Http\Requests\ProductRequest as BaseProductRequest;

class MarketPlaceSettingFormRequest extends BaseProductRequest
{
    public function rules(): array
    {
        $rules = [];
        if ($this->input('marketplace_enable_commission_fee_for_each_category')) {
            // validate request setting category commission
            $commissionByCategory = $this->input('commission_by_category');
            foreach ($commissionByCategory as $key => $item) {
                $commissionFeeName = sprintf('%s.%s.commission_fee', 'commission_by_category', $key);
                $categoryName = sprintf('%s.%s.categories', 'commission_by_category', $key);
                $rules[$commissionFeeName] = 'required|numeric|min:1,max:100';
                $rules[$categoryName] = 'required';
            }
        }

        return $rules;
    }

    public function attributes(): array
    {
        $attributes = [];

        if ($this->input('marketplace_enable_commission_fee_for_each_category') == 1) {
            // validate request setting category commission
            $commissionByCategory = $this->input('commission_by_category');
            foreach ($commissionByCategory as $key => $item) {
                $commissionFeeName = sprintf('%s.%s.commission_fee', 'commission_by_category', $key);
                $categoryName = sprintf('%s.%s.categories', 'commission_by_category', $key);
                $attributes[$commissionFeeName] = trans('plugins/marketplace::marketplace.settings.commission_fee_each_category_fee_name', ['key' => $key]);
                $attributes[$categoryName] = trans('plugins/marketplace::marketplace.settings.commission_fee_each_category_name', ['key' => $key]);
            }
        }

        return $attributes;
    }
}
