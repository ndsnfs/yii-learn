<?php

namespace app\modules\api\controllers;


use Yii;
use app\models\LoginForm;
use yii\filters\AccessControl;
use yii\rest\Controller;

class AuthController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['login'],
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['login'],
                    'roles' => ['?'],
                ]
            ],
        ];
        return $behaviors;
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->post(), '');
        if($model->validate())
        {
            return [
                'token' => $model->user->accessToken
            ];
        }
        return $model;
    }
}