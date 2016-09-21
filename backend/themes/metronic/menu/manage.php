<?php

use yii\helpers\Html;
use kartik\tree\TreeView;

/* @var $this yii\web\View */
/* @var $model common\models\BaseUser */

$this->title = ucfirst($this->context->id);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-content tree-manage">

    <!-- BEGIN STYLE CUSTOMIZER -->
    <?= $this->render('@metronicTheme/layouts/themePanel.php'); ?>
    <!-- END STYLE CUSTOMIZER -->
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        <?= Html::encode($this->title) ?>
    </h3>

    <div class="page-bar">
        <?=
        \digi\metronic\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        ?>
    </div>
    <!-- END PAGE HEADER-->
    <div class="row">

    </div>
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <div id="treeViewWidget">
                <?php
                echo TreeView::widget([
                    // single query fetch to render the tree
                    'query' => $query,
                    'headingOptions' => ['label' =>$this->title],
                    'rootOptions' => ['label' => 'Root'],
                    'nodeView' => '@metronicTheme/base/tree/_manageForm',
                    'fontAwesome' => false,
                    'isAdmin' => false,
                    'allowNewRoots' => false,
                    'displayValue' => $displayValue,
                    'iconEditSettings' => [
                        'show' => 'none',
                    ],
                    'softDelete' => false,
                ]);
                ?>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>

