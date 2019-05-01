<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * Class Car
 * @package app\models
 * @property string $uuid
 * @property string $gov_number
 * @property Gps $lastGps
 */
class Car extends ActiveRecord
{
    public function rules()
    {
        return [
            [['uuid', 'gov_number'], 'string']
        ];
    }

    public function extraFields()
    {
        return [
            'lastGps'
        ];
    }

    public function getLastGps()
    {
        return $this->hasOne(Gps::class, ['car_uuid' => 'uuid'])->orderBy(['date_start' => SORT_DESC])->limit(1);
    }
}