<?php
namespace app\commands;

use app\models\Car;
use Yii;
use yii\console\Controller;
use yii\db\Query;

class CommandController extends Controller
{
    public function actionFillCar()
    {
        $sql = 'INSERT INTO car
                    (uuid, gov_number)
                VALUES
                    (gen_random_uuid(), \'А111АА163\'),
                    (gen_random_uuid(), \'В333ВВ163\'),
                    (gen_random_uuid(), \'Г444ГГ163\'),
                    (gen_random_uuid(), \'Д555ДД163\'),
                    (gen_random_uuid(), \'Е666ЕЕ163\'),
                    (gen_random_uuid(), \'Ж777ЖЖ163\')';

        Yii::$app->db->createCommand($sql)->execute();
        echo 'Наполнение успешно завершено' . PHP_EOL;
    }

    /**
     * Для каждого кара создать несколько записей:
     * - с разными интервалами
     * - с одинаковыми gps кодами
     *
     * @throws \yii\db\Exception
     */
    public function actionFillGps()
    {
        $carsUuids = (new Query())->select('uuid')->from('car')->all();

        foreach ($carsUuids as $carUuid)
        {
            $gpsCode = bin2hex(openssl_random_pseudo_bytes(10));
            $dateTime = new \DateTime(self::randDate());
            $dateStart = $dateTime->format('Y-m-d H:i:s');
            $dateTime->add(new \DateInterval('P20D'));
            $dateEnd = $dateTime->format('Y-m-d H:i:s');
            $x = rand(2, 10);
            while($x)
            {
                $insert[] = [
                    $carUuid['uuid'], // car_uuid
                    $gpsCode, // gps_code
                    $dateStart, // date_start
                    $dateEnd // date_end
                ];
                $dateTime->add(new \DateInterval('P1D'));
                $dateStart = $dateTime->format('Y-m-d H:i:s');
                $dateTime->add(new \DateInterval('P20D'));
                $dateEnd = $dateTime->format('Y-m-d H:i:s');
                $x--;
            }
        }

        Yii::$app->db->createCommand()->batchInsert('gps', ['car_uuid', 'gps_code', 'date_start', 'date_end'], $insert)->execute();
        echo 'Наполнение успешно завершено' . PHP_EOL;
    }

    public function actionCar()
    {
        /** @var Car $car */
        $car = \app\models\TestCar::find()->where(['uuid' => '90fdabf8-b9b4-4400-aada-b170d85b368f'])->one();
//        echo $car->lastGps->date_start . PHP_EOL;
        var_dump($car->toArray());
    }

    protected static function randDate($start = '2018-01-01 00:00:00', $end = 'now')
    {
        return date('Y-m-d H:i:s', mt_rand(strtotime($start), strtotime($end)));
    }
}