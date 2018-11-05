<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HistoryServiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-service-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'entity_id') ?>

    <?= $form->field($model, 'property') ?>

    <?= $form->field($model, 'prev_value') ?>

    <?= $form->field($model, 'new_value') ?>

    <?php // echo $form->field($model, 'date_modify') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
