<?php

namespace Woo\Ads\Forms;

use AdsManager;
use Woo\Ads\Http\Requests\AdsRequest;
use Woo\Ads\Models\Ads;
use Woo\Base\Enums\BaseStatusEnum;
use Woo\Base\Forms\FormAbstract;
use Carbon\Carbon;

class AdsForm extends FormAbstract
{
    public function buildForm(): void
    {
        $this
            ->setupModel(new Ads())
            ->setValidatorClass(AdsRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('key', 'text', [
                'label' => trans('plugins/ads::ads.key'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => trans('plugins/ads::ads.key'),
                    'data-counter' => 255,
                ],
                'default_value' => generate_ads_key(),
            ])
            ->add('url', 'text', [
                'label' => trans('plugins/ads::ads.url'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'placeholder' => trans('plugins/ads::ads.url'),
                    'data-counter' => 255,
                ],
            ])
            ->add('order', 'number', [
                'label' => trans('core/base::forms.order'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.order_by_placeholder'),
                ],
                'default_value' => 0,
            ])
            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'form-control select-full',
                ],
                'choices' => BaseStatusEnum::labels(),
            ])
            ->add('location', 'customSelect', [
                'label' => trans('plugins/ads::ads.location'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'form-control select-full',
                ],
                'choices' => AdsManager::getLocations(),
            ])
            ->add('expired_at', 'text', [
                'label' => trans('plugins/ads::ads.expired_at'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'class' => 'form-control datepicker',
                ],
                'default_value' => Carbon::now()->format('m/d/Y'),
            ])
            ->add('image', 'mediaImage', [
                'label' => trans('core/base::forms.image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->setBreakFieldPoint('status');
    }
}
