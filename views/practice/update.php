<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Practice */

$this->title = 'Update Practice id: ' . $model->practice_id;
$this->params['breadcrumbs'][] = ['label' => 'Practices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="practice-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
