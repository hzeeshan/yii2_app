<?php

namespace app\controllers;

use Yii;
use app\models\Client;
use app\models\Practice;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ImportData;
use yii\web\UploadedFile;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'import'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                    [
                        'actions' => ['import'],
                        'allow' => true,
                        'roles' => ['importPractices'],

                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/practice/index');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/site/login');
    }

    /**
     * @return string|void|Response
     * Import CSV file into DB
     */
    public function actionImport()
    {
        $model = new ImportData();

        if ($model->load(Yii::$app->request->post())) {

            //get instance of incoming file
            $uploadFile = UploadedFile::getInstance($model, 'file');

            if ($uploadFile) {

                $fileCsv = array_map('str_getcsv', file($uploadFile->tempName));

                if (!empty($fileCsv)) {
                    //remove first row of the file ( file header)
                    unset($fileCsv[0]);

                    // if filetype is 'client'
                    if ($model->attributes = $_POST['type'] == 'clients') {

                        foreach ($fileCsv as $fileData) {
                            $client = new Client();
                            $client->first_name = $fileData[1];
                            $client->last_name = $fileData[2];
                            $client->fiscal_code = $fileData[3];
                            $client->note = $fileData[4];
                            $client->save();
                        }

                        // if filetype is 'Practices'
                    } elseif ($model->attributes = $_POST['type'] == 'practices') {

                        foreach ($fileCsv as $fileData) {
                            $practice = new Practice();
                            $practice->practice_id = $fileData[1];
                            $practice->creation_date = $fileData[2];
                            $practice->status = $fileData[3];
                            $practice->note = $fileData[4];
                            $practice->client_id = $fileData[5];
                            $practice->save();
                        }
                    }
                }
                return $this->redirect(['practice/index']);
            }
        } else {
            return $this->render('import', ['model' => $model]);
        }
    }
}
