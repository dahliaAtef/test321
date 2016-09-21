<?php

/**
 * Metronic Active Form
 * @author Ahmed Sharaf <sharaf.developer@gmail.com>
 * @copyright (c) 2015 Digitree (http://digitreeinc.com), All Right Reserved.
 */

namespace digi\metronic\widgets;

class ActiveForm extends \yii\bootstrap\ActiveForm {
    /**
     * @var string the default field class name when calling [[field()]] to create a new field.
     * @see fieldConfig
     */
    public $fieldClass = 'digi\metronic\widgets\ActiveField';

    /**
     * @var string the form layout. Either 'default', 'horizontal' or 'inline'.
     * By choosing a layout, an appropriate default field configuration is applied. This will
     * render the form fields with slightly different markup for each layout. You can
     * override these defaults through [[fieldConfig]].
     * @see \yii\bootstrap\ActiveField for details on Bootstrap 3 field configuration
     */
    public $layout = 'horizontal';
}
