<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii2tech\csvgrid\CsvGrid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PracticeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Practices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practice-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="form-group" style="text-align: right;">
        <?= Html::a('Export CSV', ['export'], ['class' => 'btn btn-secondary']); ?>
        <?= Html::a('Export all', ['export-all'], ['class' => 'btn btn-dark']); ?>
    </div>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{summary}\n{items}\n<div class='d-flex justify-content-center'>{pager}</div>",
        'columns' => [
            'creation_date:date',
            'practice_id',
            'status',
            'client.first_name',
            'client.last_name',
            ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '50'],
                'template' => '{view}'],
        ],
    ]);

    Yii::$app->session['_practices'] = $dataProvider;

    ?>
</div>
