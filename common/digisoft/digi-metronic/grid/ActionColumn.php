<?php

/**
 * Metronic Action Column
 * @author Ahmed Sharaf <sharaf.developer@gmail.com>
 * @copyright (c) 2015 Digitree (http://digitreeinc.com), All Right Reserved.
 */

namespace digi\metronic\grid;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

class ActionColumn extends \yii\grid\ActionColumn {

    public $template = '{view} {update} {delete}';

    /**
     * @inheritdoc
     */
    protected function initDefaultButtons() {
        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model, $key) {
                return Html::a('<i class="fa fa-eye"></i>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                ]);
            };
        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                return Html::a('<i class="fa fa-edit"></i>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                ]);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'), // Confilect with PJax
                                'data-method' => 'post',
                                'data-pjax' => '0', // That means that if you don't wish PJax to handle your links.
                ]);
            };
        }
        if (!isset($this->buttons['showroom'])) {
            $this->buttons['showroom'] = function ($url, $model, $key) {
                return Html::a('<i class="fa fa-puzzle-piece"></i>', Url::to(['showrooms-data/index', 'city_id' => $model->id]), [
                            'title' => Yii::t('yii', 'Showroom'),
                            'data-pjax' => '0',
                ]);
            };
        }
        if (!isset($this->buttons['media'])) {
            $this->buttons['media'] = function ($url, $model, $key) {
                return Html::a('<i class="fa fa-camera"></i>', Url::toRoute(['/media', 'model' => StringHelper::basename($model->className()), 'modelId' => $model->id, 'iframe' => true]), [
                            'title' => Yii::t('yii', 'Media'),
                            'class' => 'colorboxIframe',
                            'data-pjax' => '0',
                ]);
            };
        }
        if(!isset($this->buttons['receipe'])){
            $this->buttons['receipe'] = function ($url, $model, $key) {
                return Html::a('<i class="fa fa-book"></i>', Url::toRoute(['/media', 'model' => StringHelper::basename($model->className()), 'modelId' => $model->id, 'iframe' => true]), [
                            'title' => Yii::t('yii', 'Media'),
                            'class' => 'colorboxIframe',
                            'data-pjax' => '0',
                ]);
            };
        }
    }

}
