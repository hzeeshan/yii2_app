<?php

namespace app\controllers;

use app\models\Practice;
use app\models\PracticeSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2tech\csvgrid\CsvGrid;
use Yii;


/**
 * PracticeController implements the CRUD actions for Practice model.
 */
class PracticeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'create', 'update', 'view'],
                    'rules' => [
                        // allow only auth users
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Practice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PracticeSearch();

        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Practice model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Practice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Practice();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Practice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @return \yii\web\Response
     * @throws \yii\base\InvalidConfigException
     * export all the practices from DB
     */
    public function actionExportAll()
    {
        $query = Practice::find();

        $exporter = new CsvGrid([
            'dataProvider' => new ActiveDataProvider([
                'query' => $query->innerJoinWith(['client'])
            ]),
            'columns' => [
                'creation_date:date',
                'practice_id',
                'status',
                'client.first_name',
                'client.last_name',
                'client.fiscal_code'
            ],
        ]);
        return $exporter->export()->send('Practices_export_' . date("Y-m-d h:i:s") . '.csv');
    }

    /**
     * @return \yii\web\Response
     * @throws \yii\base\InvalidConfigException
     * export practices from the search results
     */

    public function actionExport()
    {
        $exporter = new CsvGrid([
            'dataProvider' => Yii::$app->session['_practices'],
            'columns' => [
                'creation_date:date',
                'practice_id',
                'status',
                'client.first_name',
                'client.last_name',
            ],
        ]);
        return $exporter->export()->send('Practices_export_' . date("Y-m-d h:i:s") . '.csv');
    }

    /**
     * Deletes an existing Practice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Practice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Practice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Practice::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
