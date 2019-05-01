<?php
/**
 * Created by PhpStorm.
 * User: nds
 * Date: 10.02.19
 * Time: 15:05
 */

namespace app\components;

use yii\base\Behavior;
use app\models\Department;


class MyBehavior extends Behavior
{
    public function events()
    {
        return [
            Department::EVENT_AFTER_FIND => 'afterFind',
            Department::EVENT_INIT => 'init',
            Department::EVENT_AFTER_UPDATE => 'afterUpdate',
            Department::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
    }

    public function afterUpdate()
    {
        echo 'afterUpdate'; exit;
    }

    public function afterFind($event)
    {
//        $event->sender->setArr('afterFind');
//        $event->sender->arrState = 'afterFind';
//        echo $this->owner->arrState; exit;
    }

    public function beforeValidate()
    {
        echo $this->owner->name; exit;
    }
}