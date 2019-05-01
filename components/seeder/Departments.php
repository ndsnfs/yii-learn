<?php

namespace app\components\seeder;

class Departments extends BaseSeeder
{
    public function data()
    {
        return [
            [
                'id' => 1,
                'pid' => null,
                'name' => 'АУР',
            ],
            [
                'id' => 2,
                'pid' => null,
                'name' => 'Отдел кадров',
            ],
            [
                'id' => 3,
                'pid' => null,
                'name' => 'Участок связи на ст. Самара',
            ],
            [
                'id' => 4,
                'pid' => null,
                'name' => 'Участок связи на ст. Кинель',
            ],
            [
                'id' => 5,
                'pid' => 3,
                'name' => 'РВБ-1',
            ],
            [
                'id' => 6,
                'pid' => 3,
                'name' => 'РВБ-2',
            ],
            [
                'id' => 7,
                'pid' => 4,
                'name' => 'РВБ-16',
            ],
            [
                'id' => 8,
                'pid' => 5,
                'name' => 'кабельщики',
            ],
            [
                'id' => 9,
                'pid' => 5,
                'name' => 'радиосвязь',
            ],
            [
                'id' => 10,
                'pid' => 5,
                'name' => 'проводная связь',
            ],
        ];
    }
}