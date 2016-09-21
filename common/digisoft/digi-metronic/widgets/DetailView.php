<?php

/**
 * Metronic Detail View
 * @author Ahmed Sharaf <sharaf.developer@gmail.com>
 * @copyright (c) 2015 Digitree (http://digitreeinc.com), All Right Reserved.
 */

namespace digi\metronic\widgets;

class DetailView extends \yii\widgets\DetailView {

    /**
     * @var string|callable the template used to render a single attribute. If a string, the token `{label}`
     * and `{value}` will be replaced with the label and the value of the corresponding attribute.
     * If a callback (e.g. an anonymous function), the signature must be as follows:
     *
     * ~~~
     * function ($attribute, $index, $widget)
     * ~~~
     *
     * where `$attribute` refer to the specification of the attribute being rendered, `$index` is the zero-based
     * index of the attribute in the [[attributes]] array, and `$widget` refers to this widget instance.
     */
    public $template = "<tr><th>{label}</th><td>{value}</td></tr>";

    /**
     * @var array the HTML attributes for the container tag of this widget. The "tag" option specifies
     * what container tag should be used. It defaults to "table" if not set.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'table table-bordered detail-view metronic-detail-view'];

}
