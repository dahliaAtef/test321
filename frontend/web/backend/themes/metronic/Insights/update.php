<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\custom\Insights */

$this->title = 'Update Insights: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Insights', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="insights-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
