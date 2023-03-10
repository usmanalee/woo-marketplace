<?php

namespace Database\Seeders;

use Woo\Base\Models\MetaBox as MetaBoxModel;
use Woo\Base\Supports\BaseSeeder;
use Woo\Ecommerce\Models\ProductCategory;
use Woo\Slug\Models\Slug;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use MetaBox;
use SlugHelper;

class ProductCategorySeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('product-categories');

        $categories = [
            [
                'name' => 'Hot Promotions',
                'icon' => 'icon-star',
            ],
            [
                'name' => 'Electronics',
                'icon' => 'icon-laundry',
                'image' => 'product-categories/1.jpg',
                'is_featured' => true,
                'children' => [
                    [
                        'name' => 'Consumer Electronic',
                        'children' => [
                            [
                                'name' => 'Home Audio & Theaters',
                            ],
                            [
                                'name' => 'TV & Videos',
                            ],
                            [
                                'name' => 'Camera, Photos & Videos',
                            ],
                            [
                                'name' => 'Cellphones & Accessories',
                            ],
                            [
                                'name' => 'Headphones',
                            ],
                            [
                                'name' => 'Videos games',
                            ],
                            [
                                'name' => 'Wireless Speakers',
                            ],
                            [
                                'name' => 'Office Electronic',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Accessories & Parts',
                        'children' => [
                            [
                                'name' => 'Digital Cables',
                            ],
                            [
                                'name' => 'Audio & Video Cables',
                            ],
                            [
                                'name' => 'Batteries',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Clothing',
                'icon' => 'icon-shirt',
                'image' => 'product-categories/2.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Computers',
                'icon' => 'icon-desktop',
                'image' => 'product-categories/3.jpg',
                'is_featured' => true,
                'children' => [
                    [
                        'name' => 'Computer & Technologies',
                        'children' => [
                            [
                                'name' => 'Computer & Tablets',
                            ],
                            [
                                'name' => 'Laptop',
                            ],
                            [
                                'name' => 'Monitors',
                            ],
                            [
                                'name' => 'Computer Components',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Networking',
                        'children' => [
                            [
                                'name' => 'Drive & Storages',
                            ],
                            [
                                'name' => 'Gaming Laptop',
                            ],
                            [
                                'name' => 'Security & Protection',
                            ],
                            [
                                'name' => 'Accessories',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Home & Kitchen',
                'icon' => 'icon-lampshade',
                'image' => 'product-categories/4.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Health & Beauty',
                'icon' => 'icon-heart-pulse',
                'image' => 'product-categories/5.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Jewelry & Watch',
                'icon' => 'icon-diamond2',
                'image' => 'product-categories/6.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Technology Toys',
                'icon' => 'icon-desktop',
                'image' => 'product-categories/7.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Phones',
                'icon' => 'icon-smartphone',
                'image' => 'product-categories/8.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Babies & Moms',
                'icon' => 'icon-baby-bottle',
            ],
            [
                'name' => 'Sport & Outdoor',
                'icon' => 'icon-baseball',
            ],
            [
                'name' => 'Books & Office',
                'icon' => 'icon-book2',
            ],
            [
                'name' => 'Cars & Motorcycles',
                'icon' => 'icon-car-siren',
            ],
            [
                'name' => 'Home Improvements',
                'icon' => 'icon-wrench',
            ],
        ];

        ProductCategory::truncate();
        Slug::where('reference_type', ProductCategory::class)->delete();
        MetaBoxModel::where('reference_type', ProductCategory::class)->delete();

        foreach ($categories as $index => $item) {
            $this->createCategoryItem($index, $item);
        }

        // Translations
        DB::table('ec_product_categories_translations')->truncate();

        $translations = [
            [
                'name' => 'Khuy???n m??i h???p d???n',
            ],
            [
                'name' => '??i???n t???',
                'children' => [
                    [
                        'name' => '??i???n t??? ti??u d??ng',
                        'children' => [
                            [
                                'name' => 'Thi???t b??? nghe nh??n',
                            ],
                            [
                                'name' => 'TV & Videos',
                            ],
                            [
                                'name' => 'Camera, Photos & Videos',
                            ],
                            [
                                'name' => '??i???n tho???i di ?????ng & Ph??? ki???n',
                            ],
                            [
                                'name' => 'Tai nghe',
                            ],
                            [
                                'name' => 'Tr?? ch??i video',
                            ],
                            [
                                'name' => 'Loa kh??ng d??y',
                            ],
                            [
                                'name' => '??i???n t??? v??n ph??ng',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Ph??? ki???n & Ph??? t??ng',
                        'children' => [
                            [
                                'name' => 'Digital Cables',
                            ],
                            [
                                'name' => 'Audio & Video Cables',
                            ],
                            [
                                'name' => 'Pin',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Qu???n ??o',
            ],
            [
                'name' => 'M??y t??nh',
                'children' => [
                    [
                        'name' => 'M??y t??nh & C??ng ngh???',
                        'children' => [
                            [
                                'name' => 'M??y t??nh & M??y t??nh b???ng',
                            ],
                            [
                                'name' => 'M??y t??nh x??ch tay',
                            ],
                            [
                                'name' => 'M??n h??nh',
                            ],
                            [
                                'name' => 'Linh ki???n M??y t??nh',
                            ],
                        ],
                    ],
                    [
                        'name' => 'M???ng m??y t??nh',
                        'children' => [
                            [
                                'name' => 'Thi???t b??? l??u tr???',
                            ],
                            [
                                'name' => 'M??y t??nh x??ch tay ch??i game',
                            ],
                            [
                                'name' => 'Thi???t b??? b???o m???t',
                            ],
                            [
                                'name' => 'Ph??? ki???n',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => '????? d??ng l??m b???p',
            ],
            [
                'name' => 'S???c kh???e & l??m ?????p',
            ],
            [
                'name' => 'Trang s???c & ?????ng h???',
            ],
            [
                'name' => '????? ch??i c??ng ngh???',
            ],
            [
                'name' => '??i???n tho???i',
            ],
            [
                'name' => 'M??? v?? b??',
            ],
            [
                'name' => 'Th??? thao & ngo??i tr???i',
            ],
            [
                'name' => 'S??ch & V??n ph??ng',
            ],
            [
                'name' => '?? t?? & Xe m??y',
            ],
            [
                'name' => 'C???i ti???n nh?? c???a',
            ],
        ];

        $count = 1;
        foreach ($translations as $translation) {
            $translation['lang_code'] = 'vi';
            $translation['ec_product_categories_id'] = $count;

            DB::table('ec_product_categories_translations')->insert(Arr::except($translation, ['children']));

            $count++;

            if (isset($translation['children'])) {
                foreach ($translation['children'] as $child) {
                    $child['lang_code'] = 'vi';
                    $child['ec_product_categories_id'] = $count;

                    DB::table('ec_product_categories_translations')->insert(Arr::except($child, ['children']));

                    $count++;

                    if (isset($child['children'])) {
                        foreach ($child['children'] as $item) {
                            $item['lang_code'] = 'vi';
                            $item['ec_product_categories_id'] = $count;

                            DB::table('ec_product_categories_translations')->insert(Arr::except($item, ['children']));

                            $count++;
                        }
                    }
                }
            }
        }
    }

    /**
     * @param int $index
     * @param array $category
     * @param int $parentId
     */
    protected function createCategoryItem(int $index, array $category, int $parentId = 0): void
    {
        $category['parent_id'] = $parentId;
        $category['order'] = $index;

        if (Arr::has($category, 'children')) {
            $children = $category['children'];
            unset($category['children']);
        } else {
            $children = [];
        }

        $createdCategory = ProductCategory::create(Arr::except($category, ['icon']));

        Slug::create([
            'reference_type' => ProductCategory::class,
            'reference_id' => $createdCategory->id,
            'key' => Str::slug($createdCategory->name),
            'prefix' => SlugHelper::getPrefix(ProductCategory::class),
        ]);

        if (isset($category['icon'])) {
            MetaBox::saveMetaBoxData($createdCategory, 'icon', $category['icon']);
        }

        if ($children) {
            foreach ($children as $childIndex => $child) {
                $this->createCategoryItem($childIndex, $child, $createdCategory->id);
            }
        }
    }
}
