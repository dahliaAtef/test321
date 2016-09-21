<?php

/**
 * Metronic Grid View
 * @author Ahmed Sharaf <sharaf.developer@gmail.com>
 * @copyright (c) 2015 Digitree (http://digitreeinc.com), All Right Reserved.
 */

namespace digi\metronic\grid;

class GridView extends \yii\grid\GridView {
    /**
     * @var array the HTML attributes for the grid table element.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $tableOptions = ['class' => 'table table-striped table-bordered table-hover dataTable no-footer'];
    /**
     * @var array the HTML attributes for the container tag of the grid view.
     * The "tag" element specifies the tag name of the container element and defaults to "div".
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'dataTables_wrapper no-footer'];
    /**
     * @var string the layout that determines how different sections of the list view should be organized.
     * The following tokens will be replaced with the corresponding section contents:
     *
     * - `{summary}`: the summary section. See [[renderSummary()]].
     * - `{errors}`: the filter model error summary. See [[renderErrors()]].
     * - `{items}`: the list items. See [[renderItems()]].
     * - `{sorter}`: the sorter. See [[renderSorter()]].
     * - `{pager}`: the pager. See [[renderPager()]].
     */
    public $layout = "<div class=\"table-scrollable\">{items}</div>\n<div class=\"row\"><div class=\"col-md-5 col-sm-12\">{summary}</div><div class=\"col-md-7 col-sm-12\"><div class=\"dataTables_paginate paging_bootstrap_full_number\">{pager}</div></div></div>";

}
