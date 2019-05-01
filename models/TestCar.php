<?php
namespace app\models;


use yii\db\ActiveRecord;

class TestCar extends ActiveRecord
{
    public static function tableName()
    {
        return 'car';
    }

    public function fields()
    {
        return [
            'uuid',
            'govNumber' => 'gov_number'
        ];
    }
}