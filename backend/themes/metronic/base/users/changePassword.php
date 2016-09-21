<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BaseUser */

$this->title = 'Update Base User: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Base Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="page-content user-update">

    <!-- BEGIN STYLE CUSTOMIZER -->
    <?=  $this->render('@metronicTheme/layouts/themePanel.php'); ?>
    <!-- END STYLE CUSTOMIZER -->
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        <?=  Html::encode($this->title); ?>
    </h3>
    <div class="page-bar">
        <?=         \digi\metronic\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        ?>
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">            
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box grey-cascade">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Change Password Form
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <?= $this->render('_changePasswordForm', [
                        'oChangePasswordForm' => $oChangePasswordForm,
                    ])
                    ?>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>
