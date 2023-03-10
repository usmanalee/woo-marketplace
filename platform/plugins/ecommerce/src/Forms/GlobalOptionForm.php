<?php

namespace Woo\Ecommerce\Forms;

use Assets;
use Woo\Base\Forms\FormAbstract;
use Woo\Ecommerce\Enums\GlobalOptionEnum;
use Woo\Ecommerce\Http\Requests\GlobalOptionRequest;
use Woo\Ecommerce\Models\GlobalOption;

class GlobalOptionForm extends FormAbstract
{
    public function buildForm()
    {
        Assets::addScripts(['jquery-ui'])->addScriptsDirectly([
            'vendor/core/plugins/ecommerce/js/global-option.js',
        ]);

        $this
            ->setupModel(new GlobalOption())
            ->setValidatorClass(GlobalOptionRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('option_type', 'customSelect', [
                'label' => trans('plugins/ecommerce::product-option.option_type'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => ['class' => 'form-control option-type'],
                'choices' => GlobalOptionEnum::options(),
            ])
            ->add('required', 'onOff', [
                'label' => trans('plugins/ecommerce::product-option.required'),
                'label_attr' => ['class' => 'control-label'],
                'default_value' => false,
            ])
            ->setBreakFieldPoint('option_type')
            ->addMetaBoxes([
                'product_options_box' => [
                    'id' => 'product_options_box',
                    'title' => trans('plugins/ecommerce::product-option.option_value'),
                    'content' => view(
                        'plugins/ecommerce::product-options.option-admin',
                        ['values' => $this->model->values->sortBy('order')]
                    )->render(),
                ],
            ]);
    }
}
