<?php

namespace app\controllers;

use app\models\Author\TopAuthorSearch;
use app\models\LoginForm;
use app\models\RegistrationForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['user', '@'],
                    ],
                    [
                        'actions' => ['login', 'index', 'registration'],
                        'allow' => true,
                        'roles' => ['guest'],
                    ],
                ],
            ]
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
        $searchModel = new TopAuthorSearch();
        $searchModel->load(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack('/site/index');
        }
        $model->username = '';
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegistration(): Response|string
    {
        if (Yii::$app->user->getIsGuest() === false) {
            return $this->goHome();
        }
        $model = new RegistrationForm();

        if (Yii::$app->request->getIsPost()) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->save();

                $loginForm = new LoginForm();
                $loginForm->username = $model->username;
                $loginForm->password = $model->password;
                $loginForm->login();

                return $this->goHome();
            }
        }

        return $this->render('registration', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
