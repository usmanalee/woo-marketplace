<?php

namespace Woo\Ecommerce\Services;

use Woo\Base\Events\CreatedContentEvent;
use Woo\Ecommerce\Models\Product;
use Woo\Ecommerce\Repositories\Interfaces\ProductTagInterface;
use Illuminate\Http\Request;

class StoreProductTagService
{
    public ProductTagInterface $productTagRepository;

    public function __construct(ProductTagInterface $productTagRepository)
    {
        $this->productTagRepository = $productTagRepository;
    }

    public function execute(Request $request, Product $product): void
    {
        $tags = $product->tags->pluck('name')->all();

        $tagsInput = collect(json_decode($request->input('tag'), true))->pluck('value')->all();

        if (count($tags) != count($tagsInput) || count(array_diff($tags, $tagsInput)) > 0) {
            $product->tags()->detach();
            foreach ($tagsInput as $tagName) {
                if (! trim($tagName)) {
                    continue;
                }

                $tag = $this->productTagRepository->getFirstBy(['name' => $tagName]);

                if ($tag === null && ! empty($tagName)) {
                    $tag = $this->productTagRepository->createOrUpdate(['name' => $tagName]);

                    $request->merge(['slug' => $tagName]);

                    event(new CreatedContentEvent(PRODUCT_TAG_MODULE_SCREEN_NAME, $request, $tag));
                }

                if (! empty($tag)) {
                    $product->tags()->attach($tag->id);
                }
            }
        }
    }
}
