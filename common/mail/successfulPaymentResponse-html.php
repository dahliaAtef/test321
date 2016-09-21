<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="message">
    <div class="title">
        <h1><?= Yii::t('app', 'Hello') ?> <?= Html::encode(Yii::$app->user->identity->getName()) ?></h1>
        <h2><?= Yii::t('app', 'Successful Payment Confirmation') ?></h2>
    </div>
    <div class="content">
        <p><?= Yii::t('app', 'Order Details') ?></p>
        <?=
        \yii\widgets\DetailView::widget([
            'model' => $oOrder,
            'attributes' => [
                'id',
                'name',
                'email:email',
                'phone',
                'address:ntext',
                'comment:ntext',
                [
                    'attribute' => 'amount',
                    'value' => $oOrder->amount . ' ' . CURRENCY_SYMBOL,
                ],
                [
                    'attribute' => 'payment_method',
                    //'format' => 'html',
                    'value' => $oOrder->payment_method ? $oOrder->paymentMethodList[$oOrder->payment_method] : '(not set)',
                ],
                [
                    'attribute' => 'paid',
                    'format' => 'html',
                    'value' => $oOrder->paid ? '<span class="badge badge-success"> Yes </span>' : '<span class="badge badge-danger"> No </span>',
                ],
                [
                    'attribute' => 'status',
                    'format' => 'html',
                    'value' => $oOrder->status ? '<span class="label label-sm order-status-' . $oOrder->status . '">' . $oOrder->statusList[$oOrder->status] . '</span>' : '(not set)',
                ],
                'created',
            ],
        ])
        ?>
    </div>
    <div class="option">
        <a href="<?= Url::to(['/profile'], true) ?>" /><span><?= Yii::t('app', 'Follow Order') ?></span></a>
    </div>
</div>
