<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
//var_dump($exception);
$this->title = $name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <!-- BEGIN STYLE CUSTOMIZER -->
    <?= $this->render('@metronicTheme/layouts/themePanel.php'); ?>
    <!-- END STYLE CUSTOMIZER -->
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        <?= Html::encode($this->title); ?>
    </h3>
    <div class="page-bar">
        <?=
        \digi\metronic\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]);
        ?>
    </div>
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12 page-404">
            <div class="number">
                <?= $exception->statusCode; ?>
            </div>
            <div class="details">
                <h3><?= nl2br(Html::encode($message)) ?></h3>
                <p>
                    The above error occurred while the Web server was processing your request.<br/>
                    <a href="<?= \yii\helpers\Url::home()?>">Return home </a>
                    Or please contact us if you think this is a server error. Thank you.
                </p>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>

