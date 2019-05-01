<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gps}}`.
 */
class m190307_202653_create_gps_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%gps}}', [
            'car_uuid' => $this->string()->notNull(),
            'gps_code' => $this->string()->notNull(),
            'date_start' => $this->dateTime()->notNull(),
            'date_end' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-gps-car_uuid',
            '{{%gps}}',
            'car_uuid',
            'car',
            'uuid'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-gps-car_uuid', 'gps');
        $this->dropTable('{{%gps}}');
    }
}
