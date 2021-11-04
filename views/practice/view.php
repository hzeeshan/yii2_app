<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Practice */

$this->title = 'Practice Id: ' . $model->practice_id;
$this->params['breadcrumbs'][] = ['label' => 'Practices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="practice-view">

    <div class="my-3">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'practice_id',
            'creation_date:date',
            'status',
            'note:ntext',
            [
                'attribute' => 'Name',
                'value' => function ($model) {
                    return $model->client->first_name . ' ' . $model->client->last_name;
                }
            ],
            'client.fiscal_code'
        ],
    ]) ?>

</div>
