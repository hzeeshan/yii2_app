<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\PracticeSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="container">
    <div class="practice-search">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'practice_id') ?>
                <?= $form->field($model, 'fiscal_code') ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

