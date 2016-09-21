<?php

namespace digi\sortable\actions;

use yii;
use yii\web\HttpException;

class Sort extends \yii\base\Action {


    public function run() {
        //$prev = \Yii::$app->request->post('prev_index');
        //$new = \Yii::$app->request->post('new_index');
        $dragged = yii::$app->request->post('dragged');
        $replacment = yii::$app->request->post('replacment');
        $sortModel = yii::$app->request->post('sortModel');
        $sortAttr = yii::$app->request->post('sortAttr');

        $oSortModel = new $sortModel;
        $oDragged = $oSortModel::findOne($dragged);
        $oReplacment = $oSortModel::findOne($replacment);
        if (!$oDragged || !$oReplacment) {
            throw new HttpException(400, 'Dragged model not found.');
        }
        
        $prev = $oDragged->{$sortAttr};
        $new = $oReplacment->{$sortAttr};
        if ($prev < $new) {
            for ($order = $prev; $order <= $new; $order++) {
                $model = $oSortModel::findOne([$sortAttr => $order]);
                if ($model) {
                    $model->{$sortAttr} --;
                    $model->update(false, [$sortAttr]);
                }
            }
        } elseif ($prev > $new) {
            for ($order = $prev; $order >= $new; $order--) {
                $model = $oSortModel::findOne([$sortAttr => $order]);
                if ($model) {
                    $model->{$sortAttr} ++;
                    $model->update(false, [$sortAttr]);
                }
            }
        }

        $oDragged->{$sortAttr} = $new;
        $oDragged->update(false, [$sortAttr]);
    }

}
