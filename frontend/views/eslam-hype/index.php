<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\custom\User;
/* @var $this yii\web\View */
/* @var $searchModel common\models\custom\search\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
if(Yii::$app->user->isGuest || (!Yii::$app->user->can('Asterisk'))){
?>
<div>FORBIDDEN</div>
<?php }else{
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            //'password',
            'mobile',
             'brand_name',
            // 'token',
            // 'token_type',
            // 'auth_key',
            // 'sso_key',
            [
                'attribute' => 'status',
                'filter' => User::getStatusList(),
                'format' => 'html',
                'value' => function ($model, $key, $index, $column) {
                    return $model->status ? '<span class="label label-sm user-status-' . $model->status . '">' . $model->statusList[$model->status] . '</span>' : '(not set)';
                },
            ],
            // 'last_login',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<?php } ?>
