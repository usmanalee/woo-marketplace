<?php

namespace Database\Seeders;

use Woo\Base\Models\MetaBox as MetaBoxModel;
use Woo\Base\Supports\BaseSeeder;
use Woo\Language\Models\LanguageMeta;
use Woo\Page\Models\Page;
use Woo\Slug\Models\Slug;
use Faker\Factory;
use Html;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SlugHelper;

class PageSeeder extends BaseSeeder
{
    public function run(): void
    {
        $faker = Factory::create();

        $pages = [
            [
                'name' => 'Home',
                'content' =>
                    Html::tag(
                        'div',
                        '[simple-slider key="home-slider" ads_1="VC2C8Q1UGCBG" ads_2="NBDWRXTSVZ8N"][/simple-slider]'
                    ) .
                    Html::tag(
                        'div',
                        '[site-features icon1="icon-rocket" title1="Free Delivery" subtitle1="For all orders over $99" icon2="icon-sync" title2="90 Days Return" subtitle2="If goods have problems" icon3="icon-credit-card" title3="Secure Payment" subtitle3="100% secure payment" icon4="icon-bubbles" title4="24/7 Support" subtitle4="Dedicated support" icon5="icon-gift" title5="Gift Service" subtitle5="Support gift service"][/site-features]'
                    ) .
                    Html::tag('div', '[flash-sale title="Deal of the day" flash_sale_id="1"][/flash-sale]') .
                    Html::tag(
                        'div',
                        '[featured-product-categories title="Top Categories"][/featured-product-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[theme-ads key_1="IZ6WU8KUALYD" key_2="ILSFJVYFGCPZ" key_3="ZDOZUZZIU7FT"][/theme-ads]'
                    ) .
                    Html::tag('div', '[featured-products title="Featured products"][/featured-products]') .
                    Html::tag(
                        'div',
                        '[theme-ads key_1="Q9YDUIC9HSWS" key_2="IZ6WU8KUALYE"][/theme-ads]'
                    ) .
                    Html::tag('div', '[product-collections title="Exclusive Products"][/product-collections]') .
                    Html::tag('div', '[product-category-products category_id="18"][/product-category-products]') .
                    Html::tag(
                        'div',
                        '[download-app title="Download WooMarketplace App Now!" subtitle="Shopping fastly and easily more with our app. Get a link to download the app on your phone." screenshot="general/app.png" android_app_url="https://www.appstore.com" ios_app_url="https://play.google.com/store"][/download-app]'
                    ) .
                    Html::tag('div', '[product-category-products category_id="23"][/product-category-products]') .
                    Html::tag(
                        'div',
                        '[newsletter-form title="Join Our Newsletter Now" subtitle="Subscribe to get information about products and coupons"][/newsletter-form]'
                    )
                ,
                'template' => 'homepage',
            ],
            [
                'name' => 'About us',
            ],
            [
                'name' => 'Terms Of Use',
            ],
            [
                'name' => 'Terms & Conditions',
            ],
            [
                'name' => 'Refund Policy',
            ],
            [
                'name' => 'Blog',
                'content' => Html::tag('p', '---'),
                'template' => 'blog-sidebar',
            ],
            [
                'name' => 'FAQs',
                'content' => Html::tag('div', '[faq title="Frequently Asked Questions"][/faq]'),
            ],
            [
                'name' => 'Contact',
                'content' => Html::tag('div', '[google-map]502 New Street, Brighton VIC, Australia[/google-map]') .
                    Html::tag(
                        'div',
                        '[contact-info-boxes title="Contact Us For Any Questions"][/contact-info-boxes]'
                    ) .
                    Html::tag('div', '[contact-form][/contact-form]')
                ,
                'template' => 'full-width',
            ],
            [
                'name' => 'Cookie Policy',
                'content' => Html::tag('h3', 'EU Cookie Consent') .
                    Html::tag(
                        'p',
                        'To use this Website we are using Cookies and collecting some Data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.'
                    ) .
                    Html::tag('h4', 'Essential Data') .
                    Html::tag(
                        'p',
                        'The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.'
                    ) .
                    Html::tag(
                        'p',
                        '- Session Cookie: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.'
                    ) .
                    Html::tag(
                        'p',
                        '- XSRF-Token Cookie: Laravel automatically generates a CSRF "token" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.'
                    ),
            ],
            [
                'name' => 'Affiliate',
            ],
            [
                'name' => 'Career',
            ],
            [
                'name' => 'Coming soon',
                'content' => Html::tag(
                    'p',
                    'Condimentum ipsum a adipiscing hac dolor set consectetur urna commodo elit parturient <br/>molestie ut nisl partu convallier ullamcorpe.'
                ) .
                    Html::tag(
                        'div',
                        '[coming-soon time="December 30, 2022 15:37:25" image="general/coming-soon.jpg"][/coming-soon]'
                    ),
                'template' => 'coming-soon',
            ],
        ];

        Page::truncate();
        DB::table('pages_translations')->truncate();
        Slug::where('reference_type', Page::class)->delete();
        MetaBoxModel::where('reference_type', Page::class)->delete();
        LanguageMeta::where('reference_type', Page::class)->delete();

        foreach ($pages as $item) {
            $item['user_id'] = 1;

            if (! isset($item['template'])) {
                $item['template'] = 'default';
            }

            if (! isset($item['content'])) {
                $item['content'] = Html::tag('p', $faker->realText(500)) . Html::tag('p', $faker->realText(500)) .
                    Html::tag('p', $faker->realText(500)) . Html::tag('p', $faker->realText(500));
            }

            $page = Page::create($item);

            Slug::create([
                'reference_type' => Page::class,
                'reference_id' => $page->id,
                'key' => Str::slug($page->name),
                'prefix' => SlugHelper::getPrefix(Page::class),
            ]);
        }

        $translations = [
            [
                'name' => 'Trang ch???',
                'content' =>
                    Html::tag(
                        'div',
                        '[simple-slider key="home-slider" ads_1="VC2C8Q1UGCBG" ads_2="NBDWRXTSVZ8N"][/simple-slider]'
                    ) .
                    Html::tag(
                        'div',
                        '[site-features icon1="icon-rocket" title1="Mi???n ph?? v???n chuy???n" subtitle1="Cho ????n h??ng t??? 2tr" icon2="icon-sync" title2="Mi???n ph?? ho??n h??ng" subtitle2="If goods have problems" icon3="icon-credit-card" title3="Thanh to??n b???o m???t" subtitle3="100% secure payment" icon4="icon-bubbles" title4="H??? tr??? 24/7" subtitle4="Dedicated support" icon5="icon-gift" title5="D???ch v??? g??i qu??" subtitle5="Support gift service"][/site-features]'
                    ) .
                    Html::tag('div', '[flash-sale title="Khuy???n m??i hot" flash_sale_id="1"][/flash-sale]') .
                    Html::tag(
                        'div',
                        '[featured-product-categories title="Danh m???c n???i b???t"][/featured-product-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[theme-ads key_1="IZ6WU8KUALYD" key_2="ILSFJVYFGCPZ" key_3="ZDOZUZZIU7FT"][/theme-ads]'
                    ) .
                    Html::tag('div', '[featured-products title="S???n ph???m n???i b???t"][/featured-products]') .
                    Html::tag(
                        'div',
                        '[theme-ads key_1="Q9YDUIC9HSWS" key_2="IZ6WU8KUALYE"][/theme-ads]'
                    ) .
                    Html::tag('div', '[product-collections title="S???n ph???m ?????c quy???n"][/product-collections]') .
                    Html::tag('div', '[product-category-products category_id="18"][/product-category-products]') .
                    Html::tag(
                        'div',
                        '[download-app title="T???i WooMarketplace App Ngay!" subtitle="Mua s???m nhanh ch??ng v?? d??? d??ng h??n v???i ???ng d???ng c???a ch??ng t??i. Nh???n li??n k???t ????? t???i xu???ng ???ng d???ng tr??n ??i???n tho???i c???a b???n." screenshot="general/app.png" android_app_url="https://www.appstore.com" ios_app_url="https://play.google.com/store"][/download-app]'
                    ) .
                    Html::tag('div', '[product-category-products category_id="23"][/product-category-products]') .
                    Html::tag(
                        'div',
                        '[newsletter-form title="Tham gia b???n tin ngay" subtitle="????ng k?? ????? nh???n th??ng tin v??? s???n ph???m v?? phi???u gi???m gi??"][/newsletter-form]'
                    )
                ,
            ],
            [
                'name' => 'V??? ch??ng t??i',
            ],
            [
                'name' => '??i???u kho???n s??? d???ng',
            ],
            [
                'name' => '??i???u kho???n v?? ??i???u ki???n',
            ],
            [
                'name' => '??i???u ki???n ho??n h??ng',
            ],
            [
                'name' => 'Tin t???c',
                'content' => Html::tag('p', '---'),
            ],
            [
                'name' => 'C??u h???i th?????ng g???p',
                'content' => Html::tag('div', '[faq title="C??c c??u h???i th?????ng g???p"][/faq]'),
            ],
            [
                'name' => 'Li??n h???',
                'content' => Html::tag('div', '[google-map]502 New Street, Brighton VIC, Australia[/google-map]') .
                    Html::tag(
                        'div',
                        '[contact-info-boxes title="Li??n h??? v???i ch??ng t??i n???u b???n c?? th???c m???c"][/contact-info-boxes]'
                    ) .
                    Html::tag('div', '[contact-form][/contact-form]')
                ,
            ],
            [
                'name' => 'Ch??nh s??ch cookie',
                'content' => Html::tag('h3', 'EU Cookie Consent') .
                    Html::tag(
                        'p',
                        'To use this website we are using Cookies and collecting some data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.'
                    ) .
                    Html::tag('h4', 'Essential Data') .
                    Html::tag(
                        'p',
                        'The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.'
                    ) .
                    Html::tag(
                        'p',
                        '- Session Cookie: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.'
                    ) .
                    Html::tag(
                        'p',
                        '- XSRF-Token Cookie: Laravel automatically generates a CSRF "token" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.'
                    ),
            ],
            [
                'name' => 'Ti???p th??? li??n k???t',
            ],
            [
                'name' => 'Tuy???n d???ng',
            ],
            [
                'name' => 'S???p ra m???t',
                'content' => Html::tag(
                    'p',
                    'Condimentum ipsum a adipiscing hac dolor set consectetur urna commodo elit parturient <br/>molestie ut nisl partu convallier ullamcorpe.'
                ) .
                    Html::tag(
                        'div',
                        '[coming-soon time="December 30, 2021 15:37:25" image="general/coming-soon.jpg"][/coming-soon]'
                    ),
            ],
        ];

        foreach ($translations as $index => $item) {
            $item['lang_code'] = 'vi';
            $item['pages_id'] = $index + 1;

            DB::table('pages_translations')->insert($item);
        }
    }
}
