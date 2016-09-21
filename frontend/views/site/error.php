<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div id="checkpoint-a" class="single-page row">

    <div class="page-title large-12 medium-12 small-12 columns">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <div class="admin-content"><?= nl2br(Html::encode($message)) ?></div>

</div>
<!--
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
-->
