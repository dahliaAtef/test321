<?php

namespace digi\sortable\grid;

use digi\sortable\assets\Asset;
use yii\helpers\Html;
use yii\helpers\Url;

class Column extends \yii\grid\Column {

//    public $headerOptions = ['style' => 'width: 20px;'];
    public $sortUrl;
    public $sortModel;
    public $sortAttr;

    public function init() {
        Asset::register($this->grid->view);
        $this->grid->tableOptions = array_merge($this->grid->tableOptions, [
            'data-sort-url' => $this->sortUrl,
            'data-sort-model' => $this->sortModel,
            'data-sort-attr' => $this->sortAttr,
        ]);
    }

    protected function renderDataCellContent($model, $key, $index) {
        return Html::tag('div', '&#9776;', [
                    'data-sortable' => 'table',
                    'class' => 'sw-handler',
        ]);
    }

}
