<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Gps
 * @package app\models
 * @property string car_uuid
 * @property string cps_code
 * @property string date_start
 * @property string date_end
 */
class Gps extends ActiveRecord
{
    public function getCar()
    {
        return $this->hasOne(Car::class, ['uuid' => 'car_uuid']);
    }
}