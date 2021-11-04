<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Practice */

$this->title = 'Create Practice';
$this->params['breadcrumbs'][] = ['label' => 'Practices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
