<?php

namespace Database\Seeders;

use Woo\Base\Supports\BaseSeeder;
use Woo\Language\Models\Language as LanguageModel;
use Woo\Language\Models\LanguageMeta;
use Woo\Setting\Models\Setting as SettingModel;

class LanguageSeeder extends BaseSeeder
{
    public function run(): void
    {
        LanguageModel::truncate();
        LanguageMeta::truncate();

        $languages = [
            [
                'lang_name' => 'English',
                'lang_locale' => 'en',
                'lang_is_default' => true,
                'lang_code' => 'en_US',
                'lang_is_rtl' => false,
                'lang_flag' => 'us',
                'lang_order' => 0,
            ],
            [
                'lang_name' => 'Tiếng Việt',
                'lang_locale' => 'vi',
                'lang_is_default' => false,
                'lang_code' => 'vi',
                'lang_is_rtl' => false,
                'lang_flag' => 'vn',
                'lang_order' => 0,
            ],
        ];

        foreach ($languages as $item) {
            LanguageModel::create($item);
        }

        SettingModel::whereIn('key', [
            'language_hide_default',
            'language_switcher_display',
            'language_display',
            'language_hide_languages',
        ])
            ->delete();

        SettingModel::insertOrIgnore([
            [
                'key' => 'language_hide_default',
                'value' => '1',
            ],
            [
                'key' => 'language_switcher_display',
                'value' => 'dropdown',
            ],
            [
                'key' => 'language_display',
                'value' => 'all',
            ],
            [
                'key' => 'language_hide_languages',
                'value' => '[]',
            ],
        ]);
    }
}
