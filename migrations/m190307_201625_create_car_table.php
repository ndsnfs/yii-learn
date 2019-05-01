<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car}}`.
 */
class m190307_201625_create_car_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car}}', [
            'gov_number' => $this->string()->notNull(),
            'uuid' => $this->string()->notNull(),
        ]);

        $this->createIndex(
            'idx-car-gov_number',
            'car',
            'gov_number',
            true
        );

        $this->createIndex(
            'idx-car-uuid',
            'car',
            'uuid',
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-car-gov_number', 'car');
        $this->dropIndex('idx-car-uuid', 'car');
        $this->dropTable('{{%car}}');
    }
}
