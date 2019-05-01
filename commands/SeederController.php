<?php

namespace app\commands;


use Yii;
use yii\console\Controller;
use yii\console\Exception;

/**
 * Class SeederController
 * @package app\commands
 */
class SeederController extends Controller
{
    public function actionRun($seedClass = null, $table = '')
    {
        if(!$seedClass) {
            throw new Exception('Укажите имя класса');
        }

        $className = 'app\components\seeder\\' . $seedClass;
        if (!file_exists('./components/seeder/' . $seedClass . '.php')) {
            throw new Exception('Класс для посева не найден');
        }
        require './components/seeder/' . $seedClass . '.php';
        if(!class_exists($className)) {
            throw new Exception('Класс для посева не найден');
        }

        $seederObj = new $className();
        $data = $seederObj->data();

        if(!$data) {
            echo 'Нет данных для посева' . PHP_EOL;
        }

        $tableName = $table ? $this->getTableName($table) : $this->getTableName($seedClass);
        $cols = array_keys($data[0]);
        $insert = [];
        foreach ($data as $item) {
            $keys = array_keys($item);
            if($keys !== $cols) {
                throw new Exception('Несоответствие названий колонок');
            }
            $insert[] = array_values($item);
        }
        Yii::$app->db->createCommand()->truncateTable($tableName)->execute();
        Yii::$app->db->createCommand()->batchInsert($tableName, $cols, $insert)->execute();
        echo 'Таблица ' . $tableName . ' успешно наполнена' . PHP_EOL;
    }

    protected function getTableName($table)
    {
        return strtolower($table);
    }
}