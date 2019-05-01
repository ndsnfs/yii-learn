<?php

namespace app\models\query;


use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class DepartmentQuery extends ActiveQuery
{
    public function parents($id)
    {
        $sql = '
            (WITH RECURSIVE r AS (
                SELECT id, pid, name
                FROM departments
                WHERE id= :id
                UNION
                SELECT departments.id, departments.pid, departments.name
                FROM departments
                INNER JOIN r ON r.pid = departments.id
            )
            SELECT id FROM r)';
        $result = Yii::$app
            ->db
            ->createCommand($sql)
            ->bindValue(':id', $id)
            ->queryAll();
        $idList = ArrayHelper::getColumn($result, 'id');
        return $this->andWhere(['in', 'id', $idList]);
    }
}