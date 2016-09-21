<?php

/**
 * Metronic Active Field
 * @author Ahmed Sharaf <sharaf.developer@gmail.com>
 * @copyright (c) 2015 Digitree (http://digitreeinc.com), All Right Reserved.
 */

namespace digi\metronic\widgets;

class ActiveField extends \yii\bootstrap\ActiveField {
    
    /**
     * @inheritdoc
     */
    protected function createLayoutConfig($instanceConfig)
    {
        $config = [
            'hintOptions' => [
                'tag' => 'p',
                'class' => 'help-block',
            ],
            'errorOptions' => [
                'tag' => 'span',
                'class' => 'help-block help-block-error',
            ],
            'inputOptions' => [
                'class' => 'form-control',
            ],
        ];

        $layout = $instanceConfig['form']->layout;

        if ($layout === 'horizontal') {
            $config['template'] = "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}";
            $cssClasses = [
                'offset' => 'col-md-offset-3',
                'label' => 'col-md-3',
                'wrapper' => 'col-md-6',
                'error' => '',
                'hint' => 'col-md-3',
            ];
            if (isset($instanceConfig['horizontalCssClasses'])) {
                $cssClasses = ArrayHelper::merge($cssClasses, $instanceConfig['horizontalCssClasses']);
            }
            $config['horizontalCssClasses'] = $cssClasses;
            $config['wrapperOptions'] = ['class' => $cssClasses['wrapper']];
            $config['labelOptions'] = ['class' => 'control-label ' . $cssClasses['label']];
            $config['errorOptions'] = ['class' => 'help-block help-block-error ' . $cssClasses['error']];
            $config['hintOptions'] = ['class' => 'help-block ' . $cssClasses['hint']];
        } elseif ($layout === 'inline') {
            $config['labelOptions'] = ['class' => 'sr-only'];
            $config['enableError'] = false;
        }

        return $config;
    }
}
