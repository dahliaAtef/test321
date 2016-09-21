<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\custom\Insights */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Insights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insights-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'model_id',
            'followers',
            'follows',
            'number_of_posted_media',
            'total_likes',
            'total_comments',
            'created',
        ],
    ]) ?>

</div>
