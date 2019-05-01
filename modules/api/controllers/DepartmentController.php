<?php

namespace app\modules\api\controllers;


use app\models\Department;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class DepartmentController extends ActiveController
{
    public $modelClass = 'app\models\Department';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
    ];

    public function actionParents($id)
    {
        return new ActiveDataProvider([
            'query' => Department::find()->parents($id)
        ]);
    }
}