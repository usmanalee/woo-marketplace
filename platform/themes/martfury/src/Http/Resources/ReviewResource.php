<?php

namespace Theme\WooMarketplace\Http\Resources;

use Carbon\Carbon;
use RvMedia;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'user_name' => $this->user->name,
            'user_avatar' => $this->user->avatar_url,
            'created_at' => $this->created_at->diffForHumans(),
            'comment' => $this->comment,
            'star' => $this->star,
            'images' => collect($this->images)->map(function ($image) {
                return [
                    'thumbnail' => RvMedia::getImageUrl($image, 'thumb'),
                    'full_url' => RvMedia::getImageUrl($image),
                ];
            }),
            'ordered_at' => $this->order_created_at ? __('✅ Purchased :time', ['time' => Carbon::createFromDate($this->order_created_at)->diffForHumans()]) : null,
        ];
    }
}
