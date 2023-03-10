<?php

namespace Woo\Ads\Http\Requests;

use Woo\Base\Enums\BaseStatusEnum;
use Woo\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;
use AdsManager;

class AdsRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'key' => 'required|max:120|unique:ads,key,' . $this->route('ads'),
            'location' => 'required|' . Rule::in(array_keys(AdsManager::getLocations())),
            'order' => 'required|integer|min:0|max:127',
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
