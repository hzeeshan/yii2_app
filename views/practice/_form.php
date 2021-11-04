<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Practice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="practice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'practice_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creation_date')->widget(DatePicker::class,
        ['dateFormat' => 'php:Y-d-m',
            'clientOptions' => [
                'changeYear' => true,
                'changeMonth' => true,
                'yearRange' => '-50:-12',
            ]], '')
        ->textInput()->input('text') ?>

    <?= $form->field($model, 'status')->dropDownList(['Open' => 'Open', 'Close' => 'Close',], ['class' => 'form-control']) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
