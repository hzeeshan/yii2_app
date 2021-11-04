<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = new app\models\ImportData();

$this->title = 'Import Data';
$this->params['breadcrumbs'][] = 'Import Data';
?>
<div class="container">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i>Saved!</h4>

        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row mt-5">
        <div class="col-md-6 col-lg-6">
            <div class="import-form">
                <b>File Type:</b>
                <div class="form-group">
                    <?= Html::dropDownList('type', $model, ['clients' => 'Clients', 'practices' => 'Practices'], ['class' => 'form-control'
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="btn-group">
                <?= $form->field($model, 'file')->fileInput(['class' => 'custom-file'])->label('') ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-12 col-lg-12">
            <div class="form-group">
                <?= Html::submitButton('Upload File', ['class' => 'btn btn-dark']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>


